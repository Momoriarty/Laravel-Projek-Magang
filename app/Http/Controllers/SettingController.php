<?php


namespace App\Http\Controllers;

use App\Models\Setting;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data = Setting::all();
        $setting = [];
        foreach ($data as $key => $value) {
            $setting[$value->setting_kode] = $value->setting_value;
        }

        return view('admin/setting', compact('setting'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'setting.nama' => 'required',
            'setting.meta_deskripsi' => 'required',
            'setting.favicon' => 'nullable|max:2048',
        ]);

        // Iterasi melalui data yang diterima dari permintaan
        foreach ($request->input('setting') as $key => $data) {
            Setting::where('setting_kode', $key)->update(['setting_value' => $data]);
            // echo $key . ' => [' . $data . '] , ';
        }

        if ($request->hasFile('setting.favicon')) {
            $Favicon = $request->file('setting.favicon');
            $nameCustom = 'Favicon-' . uniqid() . '.' . 'ico';
            $lokasiFavicon = $Favicon->storeAs('public/favicon', $nameCustom);
            if ($lokasiFavicon) {
                $oldFavicon = Setting::where('setting_kode', 'favicon')->value('setting_value');
                if ($oldFavicon) {
                    $oldFaviconPath = public_path($oldFavicon);
                    if (file_exists($oldFaviconPath)) {
                        unlink($oldFaviconPath);
                    }
                }
                Setting::where('setting_kode', 'favicon')->update(['setting_value' => '/storage/favicon/' . $nameCustom]);
            } else {
                echo "Gagal menyimpan file favicon.";
            }
        }


        return redirect()->back()->with('session', 'Settingan berhasil diupdate')->with('session_type', 'success');
    }

}
