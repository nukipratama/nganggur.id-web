<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'project_id', 'user_id', 'budget', 'message', 'duration'
    ];
}
