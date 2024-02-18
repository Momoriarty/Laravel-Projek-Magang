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

        $id_kategori = [];

        foreach ($templates as $template) {
            $id_kategori[$template->id] = $template->tk->pluck('id_kategori')->toArray();
        }

        return view('admin.template', compact('templates', 'akuns', 'kategori', 'id_kategori'));
    }


    public function create()
    {
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
            'nama_template.required' => 'Nama template wajib diisi',
            'nama_pembuat.required' => 'Nama pembuat wajib diisi',
            'html.required' => 'HTML template wajib diisi',
            'css.required' => 'CSS template wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'File harus berupa jpeg,png,jpg,gif,webp',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $uniqueFileName = 'Template-' . time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/template-images', $uniqueFileName);
        } else {
            $uniqueFileName = 'template-default.jpg';
        }

        $template = new Template;
        $template->nama_template = $request->input('nama_template');
        $template->user_id = $request->input('nama_pembuat');
        $template->html = $request->input('html');
        $template->css = $request->input('css');
        $template->js = $request->input('js');
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
        $template = Template::find($id);
        return view('admin.edit_template', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_template' => 'required|string|max:255',
            'html' => 'required|string',
            'css' => 'required|string',
            'js' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'nama_template.required' => 'Nama template wajib diisi',
            'html.required' => 'HTML template wajib diisi',
            'css.required' => 'CSS template wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'File harus berupa jpeg,png,jpg,gif,webp',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $template = Template::find($id);

        if (!$template) {
            return redirect()->route('index')->with('error', 'Data template tidak ditemukan');
        }

        if ($request->hasFile('gambar')) {
            $oldImagePath = $template->gambar;

            if ($oldImagePath != 'template-default.jpg') {
                Storage::delete("public/template-images/$oldImagePath");
            }

            $image = $request->file('gambar');

            $uniqueFileName = 'Template-' . time() . '.' . $image->getClientOriginalExtension();

            $imagePath = $image->storeAs('public/template-images', $uniqueFileName);
            $template->gambar = $uniqueFileName;
        }

        $template->nama_template = $request->input('nama_template');
        $template->user_id = $request->input('user_id');
        $template->html = $request->input('html');
        $template->css = $request->input('css');
        $template->js = $request->input('js');

        $templateKategori = template_kategori::where('id_template', $id)->get();
        $kategoriIds = $request->id_kategori;
        $existingIds = $templateKategori->pluck('id_kategori')->toArray();
        foreach ($templateKategori as $tk) {
            if (count($kategoriIds) > 0) {
                $tk->id_kategori = array_shift($kategoriIds);
                $tk->save();
            } else {
                $tk->delete();
            }
        }

        // Tambahkan kategori template baru untuk ID yang tersisa dari request
        foreach ($kategoriIds as $newId) {
            $newTemplateKategori = new template_kategori();
            $newTemplateKategori->id_template = $id;
            $newTemplateKategori->id_kategori = $newId;
            $newTemplateKategori->save();
        }




        $template->save();

        return redirect()->back()->with('session', 'Template berhasil diperbarui')->with('session_type', 'success');
    }

    public function destroy($id)
    {
        template_kategori::where('id_template', $id)->delete();
        $template = Template::find($id);

        if (!$template) {
            return redirect()->route('index')->with('error', 'Data template tidak ditemukan');
        }

        $oldImagePath = $template->gambar;

        if ($oldImagePath != 'template-default.jpg') {
            Storage::delete("public/template-images/$oldImagePath");
        }
        $template->delete();

        return redirect()->back()->with('session', 'Template berhasil diperbarui')->with('session_type', 'success');
    }

}
