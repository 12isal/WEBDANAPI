<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$role)
    {
        // dd(;

        if (!Auth::check() || !Auth::user()->hasRole($role)) {

          
            abort(403, 'Unauthorized');
          
        }
         // Dapatkan pengguna yang sedang diautentikasi
         $user = Auth::user();

         // Debug role dari pengguna
        //  dd($user->role_id);
        return $next($request);
    }
}
