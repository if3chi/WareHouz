<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

final class ClientServiceAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('Authorization')) {
            throw new AuthenticationException('Access Token Missing', guards: ['api']);
        }

        $token = Str::of($request->header('Authorization'))->after(search: 'Bearer')->toString();

        if (!$id = Cache::get($token)) {
            throw new AuthenticationException('Invalid Access Token', guards: ['api']);
        }

        dd($id);

        return $next($request);
    }
}
