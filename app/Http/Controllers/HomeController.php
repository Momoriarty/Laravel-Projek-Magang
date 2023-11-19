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
        return view('user/code', compact('Templates'));
    }
    public function show($id)
    {
        $Templates = Template::findOrFail($id); // atau Template::findOrFail($id);
        return view('user/code-show', compact('Templates'));
    }
}
