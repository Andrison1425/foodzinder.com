<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if(auth()->user()){
            if(auth()->user()->email=='admin@admin.com'){
                return $next($request);
            }else{
                return redirect()->route('index');
            }
        }else{
            return redirect()->route('index');
        }
    }
}
