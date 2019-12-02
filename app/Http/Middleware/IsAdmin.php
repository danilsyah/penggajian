<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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

        if (!(Auth::user()->is_admin == 1)) {
            // jika di akses oleh bukan admin
            return redirect('/');
        }
        // jika di akses oleh admin
        return $next($request);
    }
}
