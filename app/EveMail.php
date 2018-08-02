<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EveMail extends Model
{
    protected $fillable = [
        'sender_id',
        'reciever_ids',
        'subject',
        'can_cspa',
        'body',
        'sent'
    ];

    public $casts = [
        'reciever_ids' => 'array'
    ];

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'sender_id');
    }
}
