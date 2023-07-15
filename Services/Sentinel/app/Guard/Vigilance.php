<?php

declare(strict_types=1);

namespace App\Guard;

use Closure;
use Throwable;

final class Vigilance
{
    public static function handle(Closure $callback, ?Throwable $throwable = null)
    {
        try {
            return $callback();
        } catch (\Throwable $th) {
            if (!is_null($throwable)) {
                throw (fn () => new $this(message: $this->message, code: $this->code, previous: $th))
                    ->call($throwable);
            }
        }
    }
}
