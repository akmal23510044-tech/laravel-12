<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Ambil User yang sedang login
        $user = $request->user(); 

        // 2. Cek apakah user benar-benar ada (Login)
        if (!$user) {
            return redirect('/login'); // Atau abort(401);
        }

        // 3. Ambil Kode Level dari Relasi Database
        // Pastikan di model User.php sudah ada fungsi public function level() { ... }
        $user_role = $user->level->level_kode; 

        // 4. Cek apakah level user ada di dalam array roles yang diizinkan
        if (in_array($user_role, $roles)) {
            return $next($request);
        }

        // 5. Jika tidak punya hak akses, tampilkan error 403
        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini. Role Anda: ' . $user_role);
    }
}