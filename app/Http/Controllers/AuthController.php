<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/index');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (empty($credentials['username']) || empty($credentials['password'])) {
            return back()->withErrors(['username' => 'Silakan masukkan username dan password']);
        }

        // Lakukan proses login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 0) {
                Auth::logout();
                return back()->withErrors(['username' => 'Akun Anda tidak aktif. Silakan hubungi administrator.']);
            }

            if ($user->level == 'admin') {
                return redirect()->intended('/admin');
            } else {
                return redirect()->intended('/');
            }
        }

        // Jika proses login gagal, kirim pesan kesalahan
        return back()->withErrors(['username' => 'Username atau password tidak valid']);
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

    public function forgot(Request $request)
    {

        if ($request->get('username')) {
            $user = User::where('username', $request->get('username'))->first();
            if (!$user) {
                return redirect()->back()->with('session', 'Akun Tidak Ditemukan')->with('session_type', 'danger');
            }

            $existingToken = DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->first();

            if ($existingToken) {
                return redirect()->back()->with('session', 'Token reset password sudah ada. Silakan cek email Anda atau hubungi dukungan.')->with('session_type', 'danger');
            }

            // Generate unique token
            $token = Str::random(60);

            // Save token in the database
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            // Send email with reset password link
            Mail::to($user->email)->send(new ResetPasswordMail($token));

            // Redirect user to reset password page
            // return redirect()->route('password.reset', ['token' => $token])->with('success', 'Email reset password telah dikirim.');
            // return view('auth.emails.success');
            return redirect('/login');
        } else {
            return view('auth/forgot');
        }
    }

    public function showResetForm($token)
    {
        // Memeriksa apakah token reset password valid
        $tokenData = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$tokenData) {
            return redirect()->route('login')->with('session', 'Token reset password tidak valid.');
        }

        // Jika token valid, tampilkan formulir reset password
        return view('auth.passwords.reset', ['token' => $token]);
    }


    public function resetpassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|confirmed',
        ]);

        // Memeriksa apakah token reset password valid
        $tokenData = DB::table('password_reset_tokens')->where('token', $request->token)->first();

        if (!$tokenData) {
            return redirect()->route('login')->with('session', 'Token reset password tidak valid.');
        }

        // Cari pengguna berdasarkan alamat email dari token
        $user = User::where('email', $tokenData->email)->first();

        // Jika pengguna tidak ditemukan, kembalikan pesan kesalahan
        if (!$user) {
            return redirect()->route('login')->with('session', 'Email tidak ditemukan.');
        }

        // Atur ulang kata sandi pengguna
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token reset password dari database
        DB::table('password_reset_tokens')->where('token', $request->token)->delete();

        // Redirect pengguna setelah berhasil mengatur ulang kata sandi
        return redirect()->route('login')->with('session', 'Kata sandi telah diatur ulang.')->with('session_type', 'success');
    }



    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman setelah logout
        return redirect()->route('login');
    }
}
