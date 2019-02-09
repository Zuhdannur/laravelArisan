<?php

namespace App\Http\Middleware;

use Closure;
use Nexmo\Response;

class PegawaiMiddleware
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
        if($request->user() && $request->user()->type != 'pegawai'){
            return view('unauthorized')->with('role','PEGAWAI');
        }
        return $next($request);
    }
}
