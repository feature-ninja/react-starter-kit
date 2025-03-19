<?php

declare(strict_types=1);

namespace ControlPanel\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

final class HandleAppearance
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        EncryptCookies::except([
            'appearance',
        ]);

        View::share('appearance', $request->cookie('appearance') ?? 'system');

        return $next($request);
    }
}
