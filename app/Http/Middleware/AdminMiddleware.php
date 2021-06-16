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
            if(auth()->user()->profile==1){
                return $next($request);
            }else{
                return redirect()->route('directorio');
            }
        }else{
            return redirect()->route('directorio');
        }
    }
}
