<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\SubmittedItems;
use App\ListedItem;

class DeletePackage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var SubmittedItems
     */
    public $package;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(SubmittedItems $package)
    {
        $this->package = $package;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Delete all transactions
        foreach($this->package->items as $item) {
            foreach($item->transactions() as $trans) {
                $trans->delete();
            }
            $item->delete();
        }

        $this->package->delete();
    }
}
