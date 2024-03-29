<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'project_id', 'star', 'description'
    ];

    protected $casts = [
        'star' => 'integer',
    ];
}
