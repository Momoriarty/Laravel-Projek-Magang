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
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string',
            'email' => 'required|string|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'role' => 'required|string|in:admin,user',
            'gambar' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            // Customize error messages
            'name.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
            'email.required' => 'Email wajib diisi',
            'gambar.mimes' => 'File harus berupa gambar',
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
            $akun->profile = '/storage/profile/' . $uniqueFileName;
        } else {
            $akun->profile = $request->gambar ?? 'storage/profile/avatar0.png';
        }

        $akun->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Akun berhasil ditambah');
    }



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'no_hp' => 'nullable|string|max:20',
            'role' => 'required|string|in:admin,user',
            'gambar' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            // Customize error messages
            'name.required' => 'Nama wajib diisi',
            'username.required' => 'Username wajib diisi',
            'email.required' => 'Email wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);
        // Temukan user berdasarkan ID
        $user = User::find($id);

        // Perbarui data user
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->no_hp = $request->input('no_hp');

        // Perbarui password jika diinput, jika tidak abaikan
        if ($request->has('password') && $request->input('password') !== null) {
            $user->password = bcrypt($request->input('password'));
        }

        // Jika ada file gambar yang diunggah, simpan ke direktori
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile', $imageName);
            $user->gambar = $imageName;
        } else {
            if (isset($request->gambar)) {
                $user->profile = $request->input('gambar');
            }
        }

        // Perbarui role
        $user->role = $request->input('role');

        $user->save();

        return redirect()->back()->with('session', 'Akun berhasil diperbarui')->with('session_type', 'success');
    }



    public function destroy($id)
    {
        // Temukan user berdasarkan ID dan hapus
        User::destroy($id);

        return redirect()->back()->with('session', 'Akun berhasil Dihapus')->with('session_type', 'success');
    }
}
