<?php

namespace App\User;

enum RoleType: string
{
    case ADMIN = 'Administrator';
    case PARTNER = 'Mitra';
    case USER = 'Pelanggan';
}
