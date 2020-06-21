<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'project_id', 'chats',
    ];
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }
}
