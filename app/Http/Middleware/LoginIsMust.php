<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginIsMust
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('ADMIN_ID')){
            $request->session()->flash('error',"Please Login first to access the Page");
            return redirect('/admin/login');
        }
        else{
            return $next($request);
        }
        
    }
}
