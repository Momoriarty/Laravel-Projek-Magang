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
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
        ]);

        $akun = new User;
        $akun->name = $request->input('name');
        $akun->username = $request->input('username');
        $akun->password = bcrypt($request->input('password'));
        $akun->email = $request->input('email');
        $akun->no_hp = $request->input('no_hp');
        $akun->role = $request->input('role');

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $uniqueFileName = 'Profile-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/avatar', $uniqueFileName);
            $akun->profile = '/storage/profile/' . $uniqueFileName;
        } else {
            $akun->profile = $request->input('gambar');
        }

        $akun->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Akun added successfully');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        // Temukan user berdasarkan ID
        $user = User::find($id);

        // Perbarui data user
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Perbarui password jika diinput, jika tidak abaikan
        if ($request->has('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('akun.index')->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Temukan user berdasarkan ID dan hapus
        User::destroy($id);

        return redirect()->route('akun.index')->with('success', 'User berhasil dihapus');
    }
}
