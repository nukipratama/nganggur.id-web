<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;
    protected $fillable = [
        'name', 'email', 'password',
        'provider_name', 'provider_id',
        'role_id', 'type_id', 'email_verified_at',
    ];
    protected $hidden = [
        'password', 'remember_token', 'provider_id', 'provider_name',
    ];

    protected $casts = [
        'role_id' => 'integer',
        'type_id' => 'integer',
        'email_verified_at' => 'datetime',
    ];
    protected $with = ['details', 'role', 'type', 'partner'];

    public function details()
    {
        return $this->hasOne('App\UserDetails', 'user_id');
    }

    public function role(): HasOne
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Type', 'type_id');
    }

    public function partner(): HasOne
    {
        return $this->hasOne('App\Partner', 'user_id', 'id');
    }

    public function isAdmin(): bool
    {
        return $this->role->isAdmin();
    }

    public function isCustomer(): bool
    {
        return $this->role->isCustomer();
    }

    public function isPartner(): bool
    {
        return $this->role->isPartner();
    }
}
