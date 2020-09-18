<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = [
        'recipe_id',
        'step_photo',
        'step_description',
    ];
}
