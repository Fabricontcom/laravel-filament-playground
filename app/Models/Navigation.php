<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'url',
    ];
}
