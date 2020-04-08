<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Progress extends Model
{
    use SoftDeletes;
    protected $table = 'progresses';
    protected $fillable = [
        'project_id', 'step', 'title', 'description', 'verified_at'
    ];
}
