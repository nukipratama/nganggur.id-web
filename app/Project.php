<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'partner_id', 'subtype_id', 'status_id',
        'budget', 'title', 'description', 'views', 'duration'
    ];
}
