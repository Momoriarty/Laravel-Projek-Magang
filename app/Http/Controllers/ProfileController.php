<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\template_kategori;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Template;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $akuns = User::where('id', Auth::user()->id)->first();
        $template = Template::with('user')->where('user_id', Auth::user()->id)->get();
        $templates = Template::with('tk')->get();

        $navbar = FALSE;
        $kategori = Kategori::all();
        // Retrieve selected kategori for each template
        $selectedkategori = [];

        foreach ($templates as $t) {
            if ($t->kategoris) {
                $selectedkategori[$t->id] = $t->kategoris->pluck('id')->toArray();
            } else {
                $selectedkategori[$t->id] = [];
            }
        }

        return view('user.profile', compact('akuns', 'navbar', 'template', 'kategori', 'selectedkategori'));

    }

    public function create()
    {
        return view('akuns.create');
    }

    public function store(Request $request)
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

        try {
            // Upload image
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $uniqueFileName = 'Template-' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/template-images', $uniqueFileName);
            } else {
                $uniqueFileName = 'template-default.jpg';
            }

            $template = new Template;
            // Fill model attributes from the request
            $template->nama_template = $request->input('nama_template');
            $template->user_id = Auth::user()->id;
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


            return redirect('/profile')->with('session', 'Template created successfully')->with('session_type', 'success');
        } catch (\Exception $e) {
            // Handle any exceptions, log them, and provide a user-friendly error message
            \Log::error('Error storing template: ' . $e->getMessage());
            return redirect()->back()->with('session', $e->getMessage())->with('session_type', 'danger');
        }
    }

    // Update Profil
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $request->username,
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|numeric',
        ], [
            'name.required' => 'Nama Wajib diisi',
            'username.required' => 'Username Wajib diisi',
            'username.unique' => 'Nama pengguna ' . $request->username . ' sudah ada',
            'Email.required' => 'Email Wajib diisi',
            'no_hp.numeric' => 'No Hp hanya menggunakan angka',
        ]);

        // Temukan Akun berdasarkan ID
        $akun = User::findOrFail($id);

        if (!$akun) {
            return redirect()->back()->with('session', 'Profil tidak ditemukan')->with('session_type', 'danger');
        }

        $akun->name = $request->name;
        $akun->username = $request->username;
        $akun->email = $request->email;
        $akun->no_hp = $request->no_hp;
        $akun->save();

        return redirect()->back()->with('session', 'Profil berhasil diperbarui')->with('session_type', 'success');
    }




    public function templates(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_template' => 'required|string|max:255',
            'html' => 'required|string',
            'css' => 'required|string',
            'id_kategori' => 'required',
            'js' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'nama_template.required' => 'Nama template wajib diisi',
            'html.required' => 'HTML template wajib diisi',
            'id_kategori.required' => 'jenis Template wajib diisi',
            'css.required' => 'CSS template wajib diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'File harus berupa jpeg,png,jpg,gif,webp',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Ambil data template berdasarkan ID
        $template = Template::find($id);

        // Periksa apakah data template ditemukan
        if (!$template) {
            return redirect()->route('index')->with('session', 'Data template tidak ditemukan');
        }


        if ($request->hasFile('gambar')) {
            // Hapus gambar lama sebelum mengupload yang baru
            $oldImagePath = $template->gambar;

            // Hapus file dari penyimpanan
            if ($oldImagePath != 'template-default.jpg') {
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

        // Simpan perubahan
        $template->save();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('session', 'Tempalte berhasil diperbarui')->with('session_type', 'success');
    }

    public function destroy($id)
    {
        template_kategori::where('id_template', $id)->delete();
        $template = Template::find($id);

        if (!$template) {
            return redirect()->route('index')->with('session', 'Data template tidak ditemukan');
        }

        $oldImagePath = $template->gambar;

        if ($oldImagePath != 'template-default.jpg') {
            Storage::delete("public/template-images/$oldImagePath");
        }
        $template->delete();

        return redirect()->back()->with('session', 'Template berhasil dihapus')->with('session_type', 'success');
    }

    public function password(Request $request, $id)
    {
        $user = User::find($id);

        if (Hash::check($request->password_old, $user->password)) {
            if ($request->password_new == $request->password_k) {

                $newPassword = bcrypt($request->password_new);
                $user->update(['password' => $newPassword]);

                return redirect('profile')->with('session', 'Password berhasil diperbarui')->with('session_type', 'success');
            } else {
                return redirect()->back()->with('session', 'Password baru dengan konfirmasi tidak cocok')->with('session_type', 'danger');
            }

        } else {
            return redirect()->back()->with('session', 'Password lama tidak cocok')->with('session_type', 'danger');
        }
    }

}
