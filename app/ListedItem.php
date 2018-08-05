<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListedItem extends Model
{
    protected $fillable = [
        'package_id',
        'price',
        'item_id',
        'quantity',
        'name'
    ];

    public function package() {
        return $this->hasOne('App\SubmittedItems', 'id', 'package_id');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction', 'listed_item_id', 'id');
    }

    public function getRemainingAttribute() {
        return $this->quantity - $this->transactions->sum('amount');
    }
}
