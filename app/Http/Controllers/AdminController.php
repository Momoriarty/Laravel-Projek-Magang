<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\User; // Gantilah "YourModel" dengan nama model yang sesuai
use App\Models\Template; // Gantilah "YourModel" dengan nama model yang sesuai

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung jumlah baris di tabel
        $users = User::take(5)->get();
        $templates = Template::all();
        $kategori = Kategori::all();

        return view('admin/index', compact('users', 'templates', 'kategori'));
    }
}
