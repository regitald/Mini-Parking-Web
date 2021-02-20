<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use Session;
use Auth;

class CheckSession
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
        $data = session('Users');
        if (empty($data)) {
            return redirect('/logout');
        } 
        return $next($request);
        
    }
   
}
