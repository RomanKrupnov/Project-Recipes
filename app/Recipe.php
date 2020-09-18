<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'type_recipe',
        'photo_head',
        'kkal',
        'description',
        'cooking_time',
        'user_id',
        'difficulty',
        'is_active',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
