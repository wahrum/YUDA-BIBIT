<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $keys = [
            'site_name', 'site_tagline', 'site_description',
            'site_address', 'site_phone', 'site_whatsapp', 'site_email',
            'site_instagram', 'site_facebook',
            'whatsapp_message',
            'about_title', 'about_content',
            'site_logo',
        ];

        $settings = [];
        foreach ($keys as $key) {
            $settings[$key] = SiteSetting::get($key, '');
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'        => ['required', 'string', 'max:100'],
            'site_whatsapp'    => ['required', 'string', 'max:20'],
            'site_logo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:1024'],
        ]);

        $fields = [
            'site_name', 'site_tagline', 'site_description',
            'site_address', 'site_phone', 'site_whatsapp', 'site_email',
            'site_instagram', 'site_facebook',
            'whatsapp_message',
            'about_title', 'about_content',
        ];

        foreach ($fields as $field) {
            SiteSetting::set($field, $request->input($field, ''));
        }

        if ($request->hasFile('site_logo')) {
            $oldLogo = SiteSetting::get('site_logo');
            if ($oldLogo) {
                Storage::disk('public')->delete($oldLogo);
            }
            $path = $request->file('site_logo')->store('brand', 'public');
            SiteSetting::set('site_logo', $path);
        }

        // Clear semua cache agar perubahan langsung berlaku
        \Illuminate\Support\Facades\Cache::flush();

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
