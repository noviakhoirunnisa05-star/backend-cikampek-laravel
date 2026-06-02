<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || $request->user()->id_role != 1) {
            return response()->json([
                'message' => 'Akses ditolak. Hanya admin yang boleh mengakses fitur ini.'
            ], 403);
        }

        return $next($request);
    }
}