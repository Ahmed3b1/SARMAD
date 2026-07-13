<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description',
        'imagepath'
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

}
