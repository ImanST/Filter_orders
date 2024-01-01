<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckParameterFilterOrderRequest
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if at least one filter is provided
        if (!$request->hasAny(['status', 'amount', 'nationalCode'])) {
            return response()
                ->json(
                    ['Message' => 'At least one parameter (status, amount, nationalCode) must be filled.']
                );
        }
        return $next($request);
    }
}
