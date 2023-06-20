<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Enums\Status;
use App\Http\Concerns\HasResponse;
use Illuminate\Contracts\Support\Responsable;

final class MessageResponse implements Responsable
{
    use HasResponse;

    /**
     * @param array{message:string} $data
     * @param Status $status
     */
    public function __construct(
        private readonly array $data,
        private readonly Status $status = Status::OK,
    ) {
    }
}