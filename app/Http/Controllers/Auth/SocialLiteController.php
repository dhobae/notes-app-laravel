<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Providers\RouteServiceProvider;

class SocialLiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();


        $registeredUser = User::where("google_id", $socialUser->id)->first();
        // $registeredUser2 = User::where("email", $socialUser->email)->first();

        // user belum registrasi maka buat data baru
        if (!$registeredUser) {
            $user = User::create([
                'name' => $socialUser->name,
                'email' => $socialUser->email,
                'password' => Hash::make('nopassword'), // Pastikan ini sesuai dengan kebutuhan aplikasi Anda
                'google_id' => $socialUser->id,
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);

            // Setelah membuat user baru, maka user yang digunakan untuk login adalah user baru yang telah dibuat
            Auth::login($user);
        } else {
            // Jika user sudah terdaftar, maka langsung login dengan user yang sudah terdaftar
            Auth::login($registeredUser);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
