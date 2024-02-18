<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\template_kategori;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Template;

class HomeController extends Controller
{
    public function index()
    {
        $Templates = Template::all();
        $tk = template_kategori::all();
        $user = User::all();
        return view('user/index', compact('Templates', 'tk', 'user'));
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


        $template = Template::find($id);

        $template->kunjungan = $request->input('kunjungan') + $template['kunjungan'];

        // Simpan perubahan
        $template->save();

        return redirect('code/' . $id);
    }

    public function demo($id)
    {
        $demo = Template::where('id', $id)->first();
        return view('user/live-demo', compact('demo'));
    }

    public function kategori($id)
    {
        $kategori = Kategori::where('slug', $id)->first();
        if (empty($kategori)) {
            return redirect('/');
        }
        $tk = template_kategori::where('id_kategori', $kategori->id)->get();
        $template = [];
        foreach ($tk as $key => $data) {
            $template = Template::where('id', $data->id_template)->get();
        }
        return view('user/kategori', compact('template'));
    }
}
