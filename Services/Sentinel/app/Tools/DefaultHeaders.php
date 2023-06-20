<?php

declare(strict_types=1);

namespace App\Tools;

final class DefaultHeaders
{
    public function default(): array
    {
        return (array) config('tools.defaults.headers');
    }
}
