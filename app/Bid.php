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
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }
}
