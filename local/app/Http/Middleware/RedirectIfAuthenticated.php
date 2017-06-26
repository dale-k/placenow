<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Position;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            // $city = $request->city;
            // $lat = $request->lat;
            // $lng= $request->lng;
            // $action = 'login';

            // $position_db = New Position;
            // $position_db->storeAction($lat,$lng,$action,$city);

            return redirect('/');
        }

        return $next($request);
    }
}
