<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'type_product',
        'type_quantity',
        'image',
        'is_active',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function recipes()
    {
        return $this->belongsToMany('App\Recipe');
    }
}
