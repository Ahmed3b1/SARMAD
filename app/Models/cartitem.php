<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cartitem extends Model
{

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(product::class);
    }

    public function cart()
    {
        return $this->belongsTo(cart::class);
    }

}
