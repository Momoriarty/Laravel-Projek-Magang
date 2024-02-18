<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\User; // Gantilah "YourModel" dengan nama model yang sesuai
use App\Models\Template; // Gantilah "YourModel" dengan nama model yang sesuai

class AdminController extends Controller
{
    public function index()
    {
        $users = User::take(5)->get();
        $templates = Template::all();
        $kategori = Kategori::all();
        $setting = Setting::all();

        return view('admin/index', compact('users', 'templates', 'kategori', 'setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'meta' => 'required',
            'status' => 'required|in:1,0',
            'favicon' => 'required|image|mimes:ico|max:2048',
        ]);

        $setting = new Setting;
        $setting->nama = $request->nama;
        $setting->meta = $request->meta;
        $setting->status = $request->status;
        if ($request->has('favicon')) {
            $Favicon = $request->file('favicon');
            $nameCustom = 'Favicon-' . uniqid() . '.' . $Favicon->getClientOriginalExtension();
            $lokasiFavicon = $Favicon->storeAs('public/favicon', $nameCustom);
            $setting->favicon = '/storage/favicon/' . $nameCustom;
        }

        $setting->save();

        $settings = Setting::all();

        foreach ($settings as $no => $data) {
            if ($data->id != $setting->id) {
                if ($data->status == 1) {
                    $data->status = '0';
                    $data->save();
                }
            }
        }

        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with('session', 'Settingan berhasil ditambah')->with('session_type', 'success');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'meta' => 'required',
            'status' => 'required|in:1,0',
        ]);
        $settings = Setting::all();

        if ($request->status == 1) {
            foreach ($settings as $no => $data) {
                if ($data->id != $id) {
                    if ($data->status == 1) {
                        $data->status = '0';
                        $data->save();
                    }
                }
            }
        }

        $setting = Setting::find($id);

        $setting->nama = $request->nama;
        $setting->meta = $request->meta;
        $setting->status = $request->status;
        if ($request->hasFile('favicon')) {
            $request->validate([
                'favicon' => 'required|image|mimes:ico|max:2048',
            ]);
            $Favicon = $request->file('favicon');
            $nameCustom = 'Favicon-' . uniqid() . '.' . $Favicon->getClientOriginalExtension();
            $lokasiFavicon = $Favicon->storeAs('public/favicon', $nameCustom);
            $setting->favicon = '/storage/favicon/' . $nameCustom;
        }

        $setting->save();
        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with('session', 'Settingan berhasil diupdate')->with('session_type', 'success');
    }

    public function destroy($id)
    {
        $setting = Setting::find($id);
        $oldImagePath = public_path($setting->favicon);
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }

        $setting->delete();
        return redirect()->back()->with('session', 'Settingan berhasil di hapus')->with('session_type', 'success');
    }
}
