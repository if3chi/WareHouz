<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use App\Enums\Status;
use App\Enums\Message;

final class AuthenticationException extends Exception
{
    public static function inauthentic(
        Message $msg = Message::INAUTHENTIC,
        Status $code = Status::UNPROCESSABLE_CONTENT
    ) {
        return new self(message: $msg->value, code: $code->value);
    }

    public static function accountBotched(
        Message $msg = Message::BOTCHED,
        Status $code = Status::INTERNAL_SERVER_ERROR
    ) {
        return new self(message: $msg->value, code: $code->value);
    }
}
