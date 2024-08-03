<?php

namespace App;

use App\User\RoleType;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $casts = [
        'title' => RoleType::class,
    ];

    protected $fillable = [
        'title'
    ];

    public function isAdmin(): bool
    {
        return $this->title === RoleType::ADMIN;
    }

    public function isPartner(): bool
    {
        return $this->title === RoleType::PARTNER;
    }

    public function isCustomer(): bool
    {
        return $this->title === RoleType::USER;
    }
}
