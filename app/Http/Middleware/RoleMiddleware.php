<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Batasi akses berdasarkan kolom "role" di tabel users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$roles   Daftar role yang diizinkan, contoh: admin,staff
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Jika belum login atau rolenya tak termasuk daftar yang diizinkan
        if (! $user || ! in_array($user->role, $roles, true)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}