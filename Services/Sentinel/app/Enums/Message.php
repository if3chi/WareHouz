<?php

declare(strict_types=1);

namespace App\Enums;

enum Message: string
{
    case BOTCHED = 'Failed to create user account';
    case INAUTHENTIC = 'Invalid Credentials';
}
