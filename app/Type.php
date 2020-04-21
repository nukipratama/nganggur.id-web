<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'subtitle', 'icon'
    ];
    public function subtypes()
    {
        return $this->hasMany('App\SubTypes', 'type_id', 'id');
    }
}
