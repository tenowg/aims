<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\SubmittedItems;
use App\ListedItem;

class ProcessSubmittedItem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $item;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SubmittedItems $item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client([
            'base_url' => 'http://evepraisal.com'
        ]);

        $response = null;
        $body = new \stdClass();
        if ($this->item->evep_id) {
            $client = new Client();
            $response = $client->request('GET', 'https://evepraisal.com/a/' . $this->item->evep_id . '.json');
            $body->appraisal = json_decode((string)$response->getBody());
        } else {
            $response = $client->request('POST', 'http://evepraisal.com/appraisal.json', [
                'query' => [
                    'raw_textarea' => $this->item->raw_list,
                    'market' => $this->item->trade_hub,
                    'persist' => 'no'
                ]
            ]);
            $body = json_decode((string)$response->getBody());
        }
        
        foreach($body->appraisal->items as $item) {
            $listed = new ListedItem();
            $listed->package_id = $this->item->id;

            if ($this->item->buyorsell === 'buy') {
                $listed->price = $item->prices->buy->max;
            } else {
                $listed->price = $item->prices->sell->min;
            }
            $listed->item_id = $item->typeID;
            $listed->quantity = $item->quantity;
            $listed->name = $item->typeName;

            $listed->save();
        }
    }
}
