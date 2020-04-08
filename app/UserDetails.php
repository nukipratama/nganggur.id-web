<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDetails extends Model
{

    use SoftDeletes;
    protected $table = 'user_details';
    protected $fillable = [
        'user_id', 'identity', 'phone',
        'birth', 'address', 'photo',
        'gender',
    ];
}
