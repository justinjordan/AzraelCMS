<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function submit(Request $request)
    {
        $email = $request['email'];
        $password = $request['password'];

        if (!Auth::attempt([
            'email'     => $email,
            'password'  => $password,
            'active'    => 1,
        ])) {
            return redirect('/admin/signin');
        }

        $token = Auth::user()->createToken('Session', [
            'profile',
            'settings',
            'admin-access',
            'admin-settings',
        ])->accessToken;

        session(['accessToken' => $token]);

        return redirect()->intended('/admin/dashboard');
    }

    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            // revoke session tokens
            $tokens = $user->tokens->where('name', 'Session')->each(function ($token, $key) {
                $token->revoke();
            });

            session(['accessToken' => null]);
        }

        Auth::logout();

        return redirect('/admin/signin');
    }
}
