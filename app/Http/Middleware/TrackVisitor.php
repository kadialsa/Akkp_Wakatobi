<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visitor;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jangan hitung admin
        if (!$request->is('admin/*')) {

            $ip = $request->ip();

            $exists = Visitor::where('ip_address', $ip)
                ->whereDate('created_at', today())
                ->exists();

            if (!$exists) {
                Visitor::create([
                    'ip_address' => $ip,
                    'user_agent' => $request->userAgent(),
                ]);
            }
        }

        return $next($request);
    }
}
