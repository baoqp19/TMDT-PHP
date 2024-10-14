<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserBlockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // block >= 5 thì đã bị chặn
        if (auth()->check() && (auth()->user()->block >= 5)) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            session(['block' => true]);   // Đặt một session biến để báo hiệu người dùng đã bị chặn
            return redirect()->route('user.blocked');
        }
        return $next($request);
    }
}
