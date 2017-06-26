<?php

namespace App\Http\Middleware;
use Illuminate\Session\Store;
use Closure;
use App/Post;
class ViewPostCounter
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


        return $next($request);
    }
}
