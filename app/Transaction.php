<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'listed_item_id',
        'purchaser_id',
        'amount'
    ];

    public function item() {
        return $this->hasOne('App\ListedItem', 'id', 'listed_item_id');
    }

    public function purchaser() {
        return $this->hasOne('EveSSO\EveSSO', 'character_id', 'purchaser_id');
    }
}
