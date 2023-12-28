<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function register(Request $request)
    {
        // Validate the user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:2',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'no_hp' => $validatedData['no_hp'],
            'password' => bcrypt($validatedData['password']), // Hash the password
            'profile' => $request['gambar'],
        ]);

        // You can customize this part based on your application's logic,
        // for example, log the user in or send a confirmation email.

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman setelah logout
        return redirect()->route('login');
    }
}
