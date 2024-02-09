<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\template_kategori;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        $akuns = User::all();
        $kategori = Kategori::all();
        return view('admin.template', compact('templates', 'akuns', 'kategori'));
    }

    public function create()
    {
        // Menampilkan halaman tambah template (jika diperlukan)
        return view('admin.create_template');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_template' => 'required|string|max:255',
            'nama_pembuat' => 'required|string|max:255',
            'html' => 'required|string',
            'css' => 'required|string',
            'js' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            // Customize error messages
            'nama_template.required' => 'Nama template wajib diisi',
            'nama_pembuat.required' => 'Nama pembuat wajib diisi',
            'html.required' => 'HTML template wajib diisi',
            'css.required' => 'CSS template wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
            'id_kategori.required' => 'Kategori template wajib dipilih',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $uniqueFileName = 'Template-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/template-images', $uniqueFileName);
        } else {
            $uniqueFileName = 'img-default.jpg';
        }

        $template = new Template;
        $template->nama_template = $request->input('nama_template');
        $template->user_id = $request->input('nama_pembuat');
        $template->html = $request->input('html');
        $template->css = $request->input('css');
        $template->js = $request->input('js') ?? '//'; // Using null coalescing operator
        $template->kunjungan = '0';
        $template->gambar = $uniqueFileName;
        $template->save();


        foreach ($request->id_kategori as $kategoriId) {
            $templateKategori = new template_kategori;
            $templateKategori->id_kategori = $kategoriId;
            $templateKategori->id_template = $template->id;
            $templateKategori->save();
        }

        return redirect()->back()->with('session', 'Template berhasil ditambah')->with('session_type', 'success');
    }



    public function show($id)
    {
        $template = Template::find($id);
        return view('admin.show_template', compact('template'));
    }

    public function edit($id)
    {
        // Menampilkan halaman edit template
        $template = Template::find($id);
        return view('admin.edit_template', compact('template'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nama_template' => 'required|string|max:255',
            'nama_pembuat' => 'required|string|max:255',
            'html' => 'required|string',
            'css' => 'required|string',
            'js' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'nama_template.required' => 'Nama template wajib diisi',
            'nama_pembuat.required' => 'Nama pembuat wajib diisi',
            'html.required' => 'HTML template wajib diisi',
            'css.required' => 'CSS template wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);
        // Ambil data template berdasarkan ID
        $template = Template::find($id);

        // Periksa apakah data template ditemukan
        if (!$template) {
            return redirect()->route('index')->with('error', 'Data template tidak ditemukan');
        }

        // Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama sebelum mengupload yang baru
            $oldImagePath = $template->gambar;

            // Hapus file dari penyimpanan
            if ($oldImagePath) {
                Storage::delete("public/template-images/$oldImagePath");
            }

            $image = $request->file('gambar');

            // Generate unique filename based on current time
            $uniqueFileName = 'Template-' . time() . '.' . $image->getClientOriginalExtension();

            // Store the image with the unique filename
            $imagePath = $image->storeAs('public/template-images', $uniqueFileName);
            $template->gambar = $uniqueFileName;
        }

        // Perbarui data template dengan data baru
        $template->nama_template = $request->input('nama_template');
        $template->jenis_template = $request->input('jenis_template');
        $template->nama_pembuat = $request->input('nama_pembuat');
        $template->html = $request->input('html');
        $template->css = $request->input('css');
        $template->js = $request->input('js');

        // Simpan perubahan
        $template->save();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('session', 'Template berhasil diperbarui')->with('session_type', 'success');
    }

    public function destroy($id)
    {
        // Cari data template berdasarkan ID
        $template = Template::find($id);

        // Periksa apakah data template ditemukan
        if (!$template) {
            return redirect()->route('index')->with('error', 'Data template tidak ditemukan');
        }

        $oldImagePath = $template->gambar;

        // Hapus file dari penyimpanan
        if ($oldImagePath) {
            Storage::delete("public/template-images/$oldImagePath");
        }
        // Hapus data template
        $template->delete();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('session', 'Template berhasil diperbarui')->with('session_type', 'success');
    }

}
