<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\template_kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,' . $request->nama_kategori,
        ], [
            'nama_kategori.unique' => 'Kategori ini sudah ada',
        ]);
        $kategori = new Kategori;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->slug = Str::slug($request->nama_kategori);
        $kategori->save();
        return redirect()->back()->with('session', 'Kategori berhasil ditambah')->with('session_type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ], [
            'nama_kategori.required' => 'Nama Kategori wajib diisi'
        ]);
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect()->back()->with('session', 'Kategori berhasil diupdate')->with('session_type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->isCategoryInUse($id)) {
            return redirect()->back()->with('session', 'Kategori tidak bisa dihapus karena masih digunakan di tabel lain')->with('session_type', 'danger');
        }

        // Jika tidak digunakan, hapus kategori
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->back()->with('session', 'Kategori berhasil dihapus')->with('session_type', 'success');
    }

    private function isCategoryInUse($id)
    {
        $jumlahProduk = template_kategori::where('id_kategori', $id)->count();
        return $jumlahProduk > 0;
    }
}
