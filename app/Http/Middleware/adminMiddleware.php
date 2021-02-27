<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class adminMiddleware
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
       if(Auth::user())
       {
           if(Auth::user()->user_group_id==1)
           {
            return $next($request);
           }
           else
           {
            return redirect('/');

           }
       }
       return redirect('admin/login')->with('error','You have not admin access');
    }
}
