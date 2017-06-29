<?php

namespace App\Http\Middleware;

use Closure;

class Admin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

//        if (\Auth::user() && \Auth::user()->checkRole('role_admin')) {
//
//            return $next($request);
//
//        }

        if ($request->user() && $request->user()->checkRole('role_admin')) {

            return $next($request);

        }


        return redirect()->route('startingPage')->with('invalidate', 'You are not admin!');

    }
}
