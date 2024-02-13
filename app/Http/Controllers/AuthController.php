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
            if (Auth::user()->level = 'admin') {
                return redirect()->intended('/admin');
            } else {
                return redirect()->intended('/');
            }
        }


        // Jika autentikasi gagal
        return back()->withErrors(['username' => 'Invalid credentials']);
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $request->username,
            'password' => 'required|string',
            'k_password' => 'required|string|same:password',
            'email' => 'required|string|email|max:255',
            'no_hp' => 'nullable|string|max:20',
        ], [
            'name.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Nama pengguna ' . $request->username . ' sudah ada',
            'password.required' => 'Password wajib diisi',
            'k_password.required' => 'konfirmasi password wajib diisi',
            'k_password.same' => 'Konfirmasi password harus sama dengan password.',
            'email.required' => 'Email wajib diisi',
        ]);


        if ($request->hasFile('gambar')) {
            $validatedData = $request->validate([
                'gambar' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048',
            ], [
                'gambar.mimes' => 'File harus berupa jpeg,png,jpg,webp',
                'gambar.max' => 'Ukuran gambar maksimal 2MB',
            ]);
            $image = $request->file('gambar');
            $uniqueFileName = 'Profile-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/avatar', $uniqueFileName);
            $imgName = '/storage/avatar/' . $uniqueFileName;
        } else {
            $imgName = $request->gambar ?? '/storage/profile/avatar0.png';
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'no_hp' => $validatedData['no_hp'],
            'password' => bcrypt($validatedData['password']),
            'profile' => $imgName,
        ]);


        return redirect()->route('login')->with('session', 'Registration successful! Please log in.');
    }


    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman setelah logout
        return redirect()->route('login');
    }
}
