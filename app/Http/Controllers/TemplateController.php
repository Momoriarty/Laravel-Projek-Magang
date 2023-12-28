<?php

namespace App\Http\Controllers;

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
        return view('admin.template', compact('templates', 'akuns'));
    }

    public function create()
    {
        // Menampilkan halaman tambah template (jika diperlukan)
        return view('admin.create_template');
    }

    public function store(Request $request)
    {
        // Validation
        // $request->validate([
        //     'nama_template' => 'required',
        //     'jenis_template' => 'required',
        //     'nama_pembuat' => 'required',
        //     'html' => 'required',
        //     'css' => 'required',
        //     'js' => 'required',
        //     'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        // ]);

        // Upload image
        $image = $request->file('gambar');

        // Generate unique filename based on current time
        $uniqueFileName = 'Template-' . time() . '.' . $image->getClientOriginalExtension();

        // Store the image with the unique filename
        $imagePath = $image->storeAs('public/template-images', $uniqueFileName);

        // Membuat instance baru dari model Template
        $template = new Template;

        // Mengisi nilai atribut dari request ke model Template
        $template->nama_template = $request->input('nama_template');
        $template->jenis_template = $request->input('jenis_template');
        $template->user_id = '0';
        $template->nama_pembuat = $request->input('nama_pembuat');
        $template->html = $request->input('html');
        $template->css = $request->input('css');
        if (isset($request->js)) {
            $template->js = $request->input('js');
        } else {
            $template->js = '//';
        }
        $template->kunjungan = '0';
        $template->gambar = $uniqueFileName;
        // Menyimpan template ke database
        $template->save();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect('admin/template');
    }


    public function show($id)
    {
        // Menampilkan halaman detail template (jika diperlukan)
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
        // Validasi input
        // $request->validate([
        //     'nama_template' => 'required',
        //     'jenis_template' => 'required',
        //     'nama_pembuat' => 'required',
        //     'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        // ]);

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
        return redirect('admin/template');
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
        return redirect('admin/template');
    }

}
