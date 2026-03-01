<?php

namespace App\Http\Middleware;

use App\UsersColectionRoles;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $user = $request->user();
        if ($user->getUserColocationRole() !== UsersColectionRoles::owner->value) return back()->withErrors(['error' => 'Unauthorized action']);
        return $next($request);
    }
}
