<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmittedItems extends Model
{
    protected $fillable = [
        'buyorsell',
        'trade_hub',
        'raw_list',
        'character_id',
        'evep_id',
        'percent_range'
    ];

    public function sso() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'character_id');
    }

    public function items() {
        return $this->hasMany('App\ListedItem', 'package_id', 'id');
    }
}
