<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class hasNoColocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if(!$request->user()->getActiveColocation()->first()) return $next($request);
        return redirect('/colocations')->with('error', 'In order to create a collection, you must exit the curent one first ');
    }
}
