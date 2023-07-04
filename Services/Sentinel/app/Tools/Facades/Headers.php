<?php

declare(strict_types=1);

namespace App\Tools\Facades;

use App\Tools\DefaultHeaders;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array default()
 *
 * @see DefaultHeaders
 */
final class Headers extends Facade
{
    /**
     * @return class-string
     */
    protected static function getFacadeAccessor(): string
    {
        return DefaultHeaders::class;
    }
}