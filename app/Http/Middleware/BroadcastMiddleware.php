<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BroadcastingService;
use Symfony\Component\HttpFoundation\Response;

class BroadcastMiddleware
{
    protected $broadcastingService;


    public function __construct(BroadcastingService $broadcastingService)
    {
        $this->broadcastingService = $broadcastingService;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('api')->check()) {
            $this->broadcastingService->broadcastFloatingAuctions();
        }
        return $next($request);
    }
}
