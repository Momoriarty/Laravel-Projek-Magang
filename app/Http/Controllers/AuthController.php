<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/index');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Pastikan username dan password telah dimasukkan
        if (empty($credentials['username']) || empty($credentials['password'])) {
            return back()->withErrors(['username' => 'Please enter both username and password']);
        }

        if (Auth::attempt($credentials)) {
            // Autentikasi berhasil
            return redirect()->intended('/');
        }

        // Jika autentikasi gagal
        return back()->withErrors(['username' => 'Invalid credentials']);
    }


    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman setelah logout
        return redirect()->route('login');
    }
}
