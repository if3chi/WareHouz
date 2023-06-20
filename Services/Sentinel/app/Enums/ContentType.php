<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Type
 */
enum ContentType: string
{
    case JSON = 'application/json';
    case XML = 'application/xml';
    case HTML = 'text/html';
}
