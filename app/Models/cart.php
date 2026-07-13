<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{

    protected $fillable = [
        'session_id',
        'user_id'
    ];

    public function cartItems()
    {
        return $this->hasMany(cartitem::class);
    }


}
