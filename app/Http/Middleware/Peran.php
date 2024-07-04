<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class Peran
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $peran)
    {
        // return $next($request);
        if (Auth::check()) {
            $perans = explode('-', $peran);
            foreach ($perans as $group) {
                if (Auth::user()->role == $group) {
                    return $next($request);
                }
            }
        }

        Alert::warning('Access Denied', 'You Cannot Access the Page');
        return redirect('/administrator');
    }
}
