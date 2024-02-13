<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect('/')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        $userRole = auth()->user()->role;

        foreach ($roles as $role) {
            if ($userRole === $role) {
                return $next($request);
            }
        }

        return redirect('/')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}
