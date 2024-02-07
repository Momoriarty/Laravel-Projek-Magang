<?php
// app/Http/Middleware/CheckSiteStatus.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class CheckSiteStatus
{
    public function handle($request, Closure $next)
    {
        $activationDate = strtotime('2024-01-01'); // Gantilah dengan tanggal aktivasi yang sesuai
        $inactiveDays = 1000000;

        if (time() - $activationDate > $inactiveDays * 24 * 60 * 60) {
            // Return a custom view for inactive website
            return response(View::make('inactive'), 403);
        }

        return $next($request);
    }
}
