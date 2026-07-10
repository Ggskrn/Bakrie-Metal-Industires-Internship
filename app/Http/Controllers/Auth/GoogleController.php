<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Gagal login dengan Google. Silakan coba lagi.');
        }

        // Cari user berdasarkan email
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // Buat user baru dengan role public
            $user = User::create([
                'name'      => $googleUser->getName(),
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'role'      => 'public',
                'password'  => null,
            ]);
        } else {
            // Update google_id jika belum ada
            if (is_null($user->google_id)) {
                $user->update(['google_id' => $googleUser->getId()]);
            }
        }

        Auth::login($user);

        return redirect('/')->with('success', 'Selamat datang, ' . $user->name . '!');
    }
}