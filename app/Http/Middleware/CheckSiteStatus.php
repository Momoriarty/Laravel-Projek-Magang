<?php
// app/Http/Middleware/CheckSiteStatus.php

namespace App\Http\Middleware;

use Closure;

class CheckSiteStatus
{
    public function handle($request, Closure $next)
    {
        $activationDate = strtotime('2023-11-27'); // Gantilah dengan tanggal aktivasi yang sesuai
        $inactiveDays = 1;

        if (time() - $activationDate > $inactiveDays * 24 * 60 * 60) {
            return response("Website is currently inactive. Please contact support.", 403);
        }

        return $next($request);
    }
}

