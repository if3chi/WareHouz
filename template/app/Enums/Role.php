<?php

declare(strict_types=1);

namespace App\Enums;

enum Role: string
{
    case USER = 'user';
    case ROLE = 'role';
    case ADMIN = 'admin';
    case WAREHOUSE = 'warehouse';
}
