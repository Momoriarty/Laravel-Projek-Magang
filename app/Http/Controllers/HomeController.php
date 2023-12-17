<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;

class HomeController extends Controller
{
    public function index()
    {
        $Templates = Template::all();
        return view('user/index', compact('Templates'));
    }
    public function code()
    {
        $Templates = Template::all();
        $navbar = FALSE;
        return view('user/code', compact('Templates', 'navbar'));
    }
    public function show($id)
    {
        $Templates = Template::findOrFail($id);
        $rekomendasi = Template::orderBy('kunjungan', 'DESC')->take(3)->get();
        $navbar = FALSE;

        return view('user/code-show', compact('Templates', 'navbar', 'rekomendasi'));
    }

    public function update(Request $request, $id)
    {


        // Ambil data template berdasarkan ID
        $template = Template::find($id);

        // Perbarui data template dengan data baru
        $template->kunjungan = $request->input('kunjungan') + $template['kunjungan'];

        // Simpan perubahan
        $template->save();

        // Redirect atau berikan respons sukses sesuai kebutuhan aplikasi Anda
        return redirect('code/' . $id);
    }

    public function demo($id)
    {
        $demo = Template::where('id', $id)->first();
        return view('user/live-demo', compact('demo'));
    }
}
