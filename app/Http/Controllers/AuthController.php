<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }


    public function auth(LoginRequest $request)
    {
        $credentials = $request->validated();
        $throttleKey = 'login-attempts|' . $request->ip() . '|' . strtolower($credentials['email']);
        $lockKey = 'login-lock|' . $request->ip() . '|' . strtolower($credentials['email']);

        if (RateLimiter::tooManyAttempts($lockKey, 1)) {
            $seconds = RateLimiter::availableIn($lockKey);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'login' => "Anda gagal login 3 kali. Silakan tunggu {$seconds} detik sebelum mencoba lagi.",
                    'login_seconds' => $seconds,
                ]);
        }

        // Cek email dan password
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']

        ])) {


            $request->session()->regenerate();
            RateLimiter::clear($throttleKey);
            RateLimiter::clear($lockKey);
            $user = Auth::user();
            $roleUser = optional($user->role)->name;

            if($roleUser == 'admin' || $roleUser == 'kasir'){


                return redirect()

                    ->route('dashboard')

                    ->with('success',
                        'Selamat Datang '
                        . ucfirst($roleUser)
                        . ', '
                        . $user->name

                    );


            }

            /*
            |--------------------------------------------------------------------------
            | ROLE TIDAK DITEMUKAN
            |--------------------------------------------------------------------------
            */


            Auth::logout();
            return back()->withErrors([
                'role'=>'Role user tidak ditemukan.'
            ]);
        }

        RateLimiter::hit($throttleKey, 30);

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            RateLimiter::clear($throttleKey);
            RateLimiter::hit($lockKey, 30);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'login' => 'Anda gagal login 3 kali. Silakan tunggu 30 detik sebelum mencoba lagi.',
                    'login_seconds' => 30,
                ]);
        }

        return back()->withErrors([
            'email'=>'Email atau password tidak valid'
        ])->withInput($request->only('email'));
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()
            ->route('login')
            ->with('success',
                'Anda telah berhasil logout.'
            );

    }
}