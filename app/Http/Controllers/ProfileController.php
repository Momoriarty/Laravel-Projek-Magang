<?php

namespace App\Http\Controllers;

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
        $navbar = FALSE;

        return view('user.profile', compact('akuns', 'navbar', 'template'));

    }

    public function create()
    {
        return view('akuns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|string',
            'html' => 'required|string',
            'css' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {
            // Upload image
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $uniqueFileName = 'Template-' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('public/template-images', $uniqueFileName);
            } else {
                $uniqueFileName = 'img-default.jpg'; // or provide a default image if needed
            }

            // Create a new instance of the Template model
            $template = new Template;

            // Fill model attributes from the request
            $template->nama_template = $request->input('nama_template');
            $template->user_id = Auth::user()->id;
            $template->html = $request->input('html');
            $template->css = $request->input('css');
            $template->js = $request->input('js');
            $template->gambar = $uniqueFileName;

            // Save the template to the database
            $template->save();

            // Redirect to the user's profile page
            return redirect('/profile')->with('session', 'Template created successfully')->with('session_type', 'success');
        } catch (\Exception $e) {
            // Handle any exceptions, log them, and provide a user-friendly error message
            \Log::error('Error storing template: ' . $e->getMessage());
            return redirect()->back()->with('session', 'An error occurred while saving the template.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        // Temukan Akun berdasarkan ID
        $akun = User::findOrFail($id);

        if (!$akun) {
            // Redirect dengan pesan kesalahan
            return redirect()->back()->with('session', 'Profil tidak ditemukan')->with('session_type', 'danger');
        }

        // Update data akun
        $akun->name = $request->name;
        $akun->username = $request->username;
        $akun->email = $request->email;
        $akun->no_hp = $request->no_hp;
        $akun->save();

        // Redirect dengan pesan sukses
        return redirect()->back()->with('session', 'Profil berhasil diperbarui')->with('session_type', 'success');
    }




    public function templates(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_template' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // Ambil data template berdasarkan ID
        $template = Template::find($id);

        // Periksa apakah data template ditemukan
        if (!$template) {
            return redirect()->route('index')->with('session', 'Data template tidak ditemukan');
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
        $template->html = $request->input('html');
        $template->css = $request->input('css');
        $template->js = $request->input('js');

        // Simpan perubahan
        $template->save();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('session', 'Tempalte berhasil diperbarui')->with('session_type', 'success');
    }

    public function destroy($id)
    {
        // Cari data template berdasarkan ID
        $template = Template::find($id);

        // Periksa apakah data template ditemukan
        if (!$template) {
            return redirect()->route('index')->with('session', 'Data template tidak ditemukan');
        }

        $oldImagePath = $template->gambar;

        // Hapus file dari penyimpanan
        if ($oldImagePath) {
            Storage::delete("public/template-images/$oldImagePath");
        }
        // Hapus data template
        $template->delete();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect()->back()->with('session', 'Template berhasil dihapus')->with('session_type', 'success');
    }

    public function password(Request $request, $id)
    {
        $user = User::find($id);

        if (Hash::check($request->password_old, $user->password)) {
            if ($request->password_new == $request->password_k) {

                $newPassword = bcrypt($request->password_new);
                $user->update(['password' => $newPassword]);

                // Redirect dengan pesan sukses
                return redirect('profile')->with('session', 'Password berhasil diperbarui')->with('session_type', 'success');
            } else {
                // Redirect dengan pesan kesalahan
                return redirect()->back()->with('session', 'Password baru dengan konfirmasi tidak cocok')->with('session_type', 'danger');
            }

        } else {
            // Redirect dengan pesan kesalahan
            return redirect()->back()->with('session', 'Password lama tidak cocok')->with('session_type', 'danger');
        }
    }

}
