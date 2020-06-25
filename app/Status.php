<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    public $timestamps = false;
    protected $table = 'statuses';
    protected $fillable = [
        'name', 'color'
    ];
}
