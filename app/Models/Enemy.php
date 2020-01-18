<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enemy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'life',
        'damage',
        'moves'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'moves' => 'json',
     ];
}
