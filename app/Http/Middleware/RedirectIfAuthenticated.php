<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

                if ($guard === 'security') {
                    return redirect()->route('security.home');
                }
                if ($guard === 'sourching') {
                    return redirect()->route('sourching.home');
                }
                if ($guard === 'timbangan') {
                    return redirect()->route('timbangan.home');
                }
                if ($guard === 'lab') {
                    return redirect()->route('qc.lab.home');
                }
                if ($guard === 'bongkar') {
                    return redirect()->route('qc.bongkar.home');
                }
                if ($guard === 'spvap') {
                    return redirect()->route('ap.spv.home');
                }
                if ($guard === 'ap') {
                    return redirect()->route('ap.home');
                }
                if ($guard === 'spv') {
                    return redirect()->route('qc.spv.home');
                }
                if ($guard === 'master') {
                    return redirect()->route('master.home');
                }
                return redirect()->route('user.home');
                // return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
