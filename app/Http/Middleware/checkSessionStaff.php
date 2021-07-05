<?php

namespace App\Http\Middleware;

use Closure;

class checkSessionStaff
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
        if($request->session()->has('staff_email')){
         return $next($request);
        }
        return redirect()->route('staffLogin')->with('err','Please login to continue!');    }
}
