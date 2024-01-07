<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $roles = [
            'admin' => ['admin'],
            'member' => ['member'],
            'admin,member' => ['admin', 'member'],
        ];
        $role_in = $roles[$role] ?? [];
        if(!in_array(auth()->user()->role, $role_in)){
            abort(403);
        }
        return $next($request);
    }
}
