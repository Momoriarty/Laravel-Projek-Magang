<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Gantilah "YourModel" dengan nama model yang sesuai
use App\Models\Template; // Gantilah "YourModel" dengan nama model yang sesuai

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung jumlah baris di tabel
        $Users = User::count();
        $Templates = Template::count();

        return view('admin/index', compact('Users' , 'Templates'));
    }
}
