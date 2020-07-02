<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;
    protected $with = ['user', 'partner', 'project'];
    protected $fillable = [
        'project_id', 'chats', 'user_id', 'partner_id'
    ];
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }
    public function partner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'partner_id');
    }
}
