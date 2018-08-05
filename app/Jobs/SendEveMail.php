<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use EveEsi\Mail;
use EveEsi\Character;
use EveSSO\EveSSO;
use App\EveMail;

class SendEveMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(EveMail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mail $esi, Character $esi_char)
    {
        $rec_sso = [];
        foreach($this->mail->reciever_ids as $reciever) {
            $rec = EveSSO::where(['character_id' => $reciever])->firstOrFail();
            if ($rec !== null) {
                array_push($rec_sso, $rec);
            }
        }

        $test = $esi_char->getCspa($this->mail->sso, ...$rec_sso);
//var_dump($this->mail->body);
        $sent = $esi->sendMail($this->mail->sso, $this->mail->body, $this->mail->subject, 0, ...$rec_sso);
    }
}
