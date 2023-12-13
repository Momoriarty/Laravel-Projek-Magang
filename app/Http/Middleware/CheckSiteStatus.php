<?php
// app/Http/Middleware/CheckSiteStatus.php

namespace App\Http\Middleware;

use Closure;

class CheckSiteStatus
{
    public function handle($request, Closure $next)
    {
        $activationDate = strtotime('2024-1-1'); // Gantilah dengan tanggal aktivasi yang sesuai
        $inactiveDays = 10;

        if (time() - $activationDate > $inactiveDays * 24 * 60 * 60) {
            return response("Website is currently inactive. Please contact support.", 403);
        }

        return $next($request);
    }
}

