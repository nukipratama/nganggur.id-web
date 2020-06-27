<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubTypes extends Model
{
    public $timestamps = false;
    protected $table = 'sub_types';
    protected $with = 'type';
    protected $fillable = [
        'type_id', 'title', 'subtitle', 'icon'
    ];
    public function projects()
    {
        return $this->hasMany('App\Project', 'subtype_id', 'id');
    }
    public function type()
    {
        return $this->belongsTo('App\Type', 'type_id');
    }
}
