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
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function partner()
    {
        return $this->belongsTo('App\User', 'partner_id');
    }
    public function subtype()
    {
        return $this->belongsTo('App\SubTypes', 'subtype_id');
    }
    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id');
    }
    public function bids()
    {
        return $this->hasMany('App\Bid', 'project_id', 'id')->orderBy('bids.created_at', 'DESC');
    }
    public function progress()
    {
        return $this->hasMany('App\Progress', 'project_id', 'id')->orderBy('progresses.created_at', 'DESC');
    }
    public function payment()
    {
        return $this->hasOne('App\Payment', 'project_id');
    }
}
