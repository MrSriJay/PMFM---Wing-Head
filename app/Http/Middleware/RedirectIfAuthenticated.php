<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'dg' || Auth::user()->usertype == 's01' || Auth::user()->usertype == 'c-controller' || Auth::user()->usertype == 'c-coordinator' || Auth::user()->usertype == 'hq')
                {
                    return redirect('/admin');
                }
                else if (Auth::user()->usertype == 'winghead')
                {
                    return redirect('/winghead');
                }
                else if (Auth::user()->usertype == 'developer')
                {
                    return redirect('/developer');
                }
                else if (Auth::user()->usertype == 'officer')
                {
                    return redirect('/developer');
                }
                else if (Auth::user()->usertype == 'client')
                {
                    return redirect('/client');
                }
                else
                {
                    return 'home';
                }
               
            }
        }

        return $next($request);
    }
}
