<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if ($request->routeIs('security.*')) {
                return route('security.login');
            }
            if ($request->routeIs('sourching.*')) {
                return route('sourching.login');
            }
            if ($request->routeIs('timbangan.*')) {
                return route('timbangan.login');
            }
            if ($request->routeIs('qc.lab*')) {
                return route('qc.lab.login');
            }
            if ($request->routeIs('qc.bongkar*')) {
                return route('qc.bongkar.login');
            }
            if ($request->routeIs('ap.spv*')) {
                return route('ap.spv.login');
            }
            if ($request->routeIs('qc.spv*')) {
                return route('qc.spv.login');
            }
            if ($request->routeIs('ap*')) {
                return route('ap.login');
            }
            if ($request->routeIs('master*')) {
                return route('master.login');
            }
            return route('user.login');
        }
    }
}
