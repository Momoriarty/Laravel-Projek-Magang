<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\template_kategori;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\View;

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
        $Templates = Template::paginate(4);
        $navbar = FALSE;
        return view('user/code', compact('Templates', 'navbar'));
    }
    public function show($id)
    {
        $Templates = Template::findOrFail($id);
        $rekomendasi = Template::orderBy('kunjungan', 'DESC')
            ->where('id', '!=', $id)
            ->take(3)
            ->get();
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

        $filecss = public_path('css/styles.css');
        file_put_contents($filecss, $demo->css);

        $filejs = public_path('js/main.js');
        file_put_contents($filejs, $demo->js);

        return view('user/live-demo', compact('demo'));
    }


    public function kategori($id)
    {
        $navbar = FALSE;
        $kategori = Kategori::where('slug', $id)->first();
        if (empty($kategori)) {
            return redirect('/');
        }
        $tk = template_kategori::where('id_kategori', $kategori->id)->get();

        // dd($kategori,$tk);
        return view('user/kategori', compact('navbar', 'tk', 'kategori'));
    }
}
