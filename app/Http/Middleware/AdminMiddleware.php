<?php

namespace App\Http\Middleware;

use Closure;
//因为本身的守卫admin不知道怎么中转，所以自己定义了一个middleware

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
        if(!\Auth::guard('admin')->check()){
            return redirect('/admin/index');
        }
        return $next($request);
    }
}
