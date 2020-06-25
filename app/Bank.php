<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'code',
    ];
}
