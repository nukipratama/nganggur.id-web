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
        'gender', 'bank_id', 'bank_account', 'bank_account_name',
    ];
    public function bank()
    {
        return $this->belongsTo('App\Bank', 'bank_id');
    }
}
