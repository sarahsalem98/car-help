<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkLang
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
        app()->setlocale('ar');
        $lang = $request->header('lang');
        if(isset($lang)&& $lang=='en'){
            app()->setlocale('en');
            return $next($request);
        }
        return $next($request);
    }
}
