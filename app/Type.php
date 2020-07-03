<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title', 'subtitle', 'icon', 'color'
    ];
    public function subtypes()
    {
        return $this->hasMany('App\SubTypes', 'type_id', 'id');
    }
}
