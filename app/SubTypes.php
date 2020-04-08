<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubTypes extends Model
{
    use SoftDeletes;
    protected $table = 'sub_types';
    protected $fillable = [
        'type_id', 'title', 'subtitle', 'icon'
    ];
}
