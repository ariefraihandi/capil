<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->query('token');
        $officeId = $request->query('office_id');
        $type = $request->query('type');

        // Jika ada nilai token, office_id, dan type, simpan ke dalam sesi
        if ($token && $officeId && $type) {
            $request->session()->put('referral_token', $token);
            $request->session()->put('office_id', $officeId);
            $request->session()->put('type', $type);
        }

        // Periksa apakah pengguna terautentikasi
        if (Auth::check()) {
            // Jika terautentikasi, ambil pengguna
            $user = Auth::user();
            // dd($user);
            // Set session dengan role pengguna
            $request->session()->put('role', $user->role);
            $request->session()->put('user_id', $user->id);                
            
            // Jika pengguna mengakses /login, arahkan ke profil akun
            if ($request->is('login')) {
                return redirect()->route('admin.permohonan');
            }
            
            // Lanjutkan ke rute yang diminta
            return $next($request);
        }
        
        // Simpan URL tujuan ke sesi
        $request->session()->put('url.intended', $request->fullUrl());

        $response = [
            'success' => false,
            'title' => 'Gagal',
            'message' => 'Anda perlu login untuk mengakses halaman ini.',
        ];

        if ($request->expectsJson()) {
            return response()->json($response, 401);
        }

        return redirect()->route('login.view')->with('response', $response);
    }
}
