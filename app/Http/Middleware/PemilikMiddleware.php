<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
class PemilikMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && $request->user()->type != 'pemilik'){
            return new Response(view('layouts.unauthorized')->with('role','PEMILIK'));
        }
        return $next($request);
    }
}
