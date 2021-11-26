<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuspendProvider
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
        if(Auth::user()->suspended==1){
            return response()->json([
                'error'=>'you have been suspened from the adminstrator and no longer you can access this app '
                
            ],403);

        }else{

            return $next($request);
        }
    }
}
