<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;

class AkunController extends Controller
{
    public function index()
    {
        $akuns = Akun::all();
        return view('admin.akun', compact('akuns'));
    }

    public function create()
    {
        return view('akuns.create');
    }

    public function store(Request $request)
    {
        $akun = new Akun;
        $akun->name = $request->input('name');
        $akun->username = $request->input('username');
        $akun->password = $request->input('password'); // Perhatikan bahwa penyimpanan password ini tidak aman
        $akun->email = $request->input('email');
        $akun->no_hp = $request->input('no_hp');
        $akun->level = $request->input('level');

        $akun->save();


        return redirect('admin/akun');
    }

    public function show($id)
    {
        $akun = akun::find($id);
        return view('akuns.show', compact('akun'));
    }

    public function edit($id)
    {
        $akun = akun::find($id);
        return view('akuns.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {

        // Ambil data akun berdasarkan ID
        $akun = Akun::find($id);

        // Periksa apakah data akun ditemukan
        if (!$akun) {
            // Handle jika data tidak ditemukan, misalnya redirect ke halaman lain atau tampilkan pesan kesalahan
            return redirect()->route('index')->with('error', 'Data akun tidak ditemukan');
        }

        // Perbarui data akun dengan data baru
        $akun->name = $request->input('name');
        $akun->username = $request->input('username');
        $akun->password = $request->input('password'); // Pastikan melakukan validasi dan penyimpanan password yang aman
        $akun->email = $request->input('email');
        $akun->no_hp = $request->input('no_hp');
        $akun->level = $request->input('level');

        // Simpan perubahan
        $akun->save();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect('admin/akun');
    }

    public function destroy($id)
    {
        // Cari data akun berdasarkan ID
        $akun = Akun::find($id);

        // Periksa apakah data akun ditemukan
        if (!$akun) {
            return redirect()->route('index')->with('error', 'Data akun tidak ditemukan');
        }

        // Hapus data akun
        $akun->delete();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect('admin/akun');
    }

}
