<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Sesuaikan dengan namespace model User Anda

class AkunController extends Controller
{
    public function index()
    {
        $akuns = User::all();
        return view('admin.akun', compact('akuns'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $request->username,
            'password' => 'required|string',
            'k_password' => 'required|string|same:password',
            'email' => 'required|string|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'role' => 'required|string|in:admin,user',
            'gambar' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Nama pengguna ' . $request->username . ' sudah ada',
            'password.required' => 'Password wajib diisi',
            'k_password.required' => 'konfirmasi password wajib diisi',
            'k_password.same' => 'Konfirmasi password harus sama dengan password.',
            'email.required' => 'Email wajib diisi',
            'gambar.mimes' => 'File harus berupa jpeg,png,jpg,webp',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $akun = new User;
        $akun->name = $validatedData['name'];
        $akun->username = $validatedData['username'];
        $akun->password = bcrypt($validatedData['password']);
        $akun->email = $validatedData['email'];
        $akun->no_hp = $validatedData['no_hp'];
        $akun->role = $validatedData['role'];

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $uniqueFileName = 'Profile-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/avatar', $uniqueFileName);
            $akun->profile = '/storage/avatar/' . $uniqueFileName;
        } else {
            $akun->profile = $request->gambar ?? '/storage/profile/avatar0.png';
        }

        $akun->save();

        // Redirect back with a success message
        return redirect()->back()->with('session', 'Akun berhasil ditambah')->with('session_type', 'success');
    }



    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'role' => 'required|string|in:admin,user',
        ], [
            'name.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Nama pengguna ' . $user->username . ' sudah ada',
            'email.required' => 'Email wajib diisi',
        ]);


        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
        $user->role = $request->input('role');


        if ($request->has('password') && $request->input('password') !== null) {
            $user->password = bcrypt($request->input('password'));
        }

        $data = [
            '/storage/profile/avatar0.png',
            '/storage/profile/avatar1.png',
            '/storage/profile/avatar2.png',
            '/storage/profile/avatar3.png',
            '/storage/profile/avatar4.png',
            '/storage/profile/avatar5.png',
            '/storage/profile/avatar6.png',
            '/storage/profile/avatar7.png',
            '/storage/profile/avatar8.png',
        ];

        // Jika ada gambar yang diunggah
        if ($request->hasFile('gambar')) {
            // Validasi dan proses gambar baru
            $validatedData = $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            ], [
                'gambar.image' => 'File harus berupa gambar',
                'gambar.mimes' => 'Gambar harus berupa jpeg, png, jpg, atau webp',
                'gambar.max' => 'Ukuran gambar maksimal 2MB',
            ]);

            // Hapus gambar lama jika bukan gambar default
            if ($user->profile && !in_array($user->profile, $data)) {
                $oldImagePath = public_path($user->profile);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Proses gambar baru
            $image = $request->file('gambar');
            $imageName = 'Profile-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/avatar', $imageName);
            $user->profile = '/storage/avatar/' . $imageName;
        } elseif (isset($request->gambar) && $request->gambar !== $user->profile) {
            $user->profile = $request->gambar;
        }


        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');
        $user->role = $request->input('role');

        // Periksa dan enkripsi kata sandi jika ada perubahan
        if ($request->has('password') && $request->input('password') !== null) {
            $user->password = bcrypt($request->input('password'));
        }

        // Simpan perubahan
        $user->save();

        // Redirect kembali dengan pesan sesuai
        return redirect()->back()->with('session', 'Akun berhasil diperbarui')->with('session_type', 'success');
    }



    public function destroy($id)
    {
        // Ambil pengguna dari database berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('session', 'User tidak ditemukan')->with('session_type', 'error');
        }

        // Daftar avatar default
        $defaultAvatars = [
            '/storage/profile/avatar0.png',
            '/storage/profile/avatar1.png',
            '/storage/profile/avatar2.png',
            '/storage/profile/avatar3.png',
            '/storage/profile/avatar4.png',
            '/storage/profile/avatar5.png',
            '/storage/profile/avatar6.png',
            '/storage/profile/avatar7.png',
            '/storage/profile/avatar8.png',
        ];

        // Periksa apakah gambar profil pengguna bukan default
        if (!in_array($user->profile, $defaultAvatars)) {
            $oldImagePath = public_path($user->profile);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Hapus gambar profil pengguna
            }
        }

        // Hapus pengguna dari database
        $user->delete();

        return redirect()->back()->with('session', 'Akun berhasil Dihapus')->with('session_type', 'success');
    }

}
