<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Belum login
        if (!$user) {
            return redirect()->route('login')
                ->withErrors(['Silakan login terlebih dahulu.']);
        }

        // Aman dari relasi role yang null
        $userRole = $user->role?->name;

        if (!$userRole) {
            abort(403, 'Role tidak ditemukan');
        }

        // Cek apakah role user termasuk yang diizinkan
        if (!in_array($userRole, $roles, true)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}