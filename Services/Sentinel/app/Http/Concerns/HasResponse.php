<?php

declare(strict_types=1);

namespace App\Http\Concerns;

use App\Enums\Status;
use Illuminate\Http\Request;
use App\Tools\Facades\Headers;
use Illuminate\Http\JsonResponse;

/**
 * @property-read mixed $data
 * @property-read Status $status
 */
trait HasResponse
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: $this->data,
            status: $this->status->value,
            headers: Headers::default(),
        );
    }
}