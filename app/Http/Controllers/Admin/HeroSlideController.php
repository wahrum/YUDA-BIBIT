<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $heroSlides  = HeroSlide::forHero()->orderBy('sort_order')->orderBy('id')->get();
        $aboutSlides = HeroSlide::forAbout()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.slides.index', compact('heroSlides', 'aboutSlides'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'      => ['required', 'in:hero,about'],
            'images'    => ['required', 'array', 'min:1'],
            'images.*'  => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'title'     => ['nullable', 'string', 'max:100'],
            'subtitle'  => ['nullable', 'string', 'max:200'],
        ]);

        $type      = $request->input('type');
        $lastOrder = HeroSlide::where('type', $type)->max('sort_order') ?? 0;

        foreach ($request->file('images') as $i => $file) {
            $folder = $type === 'hero' ? 'slides/hero' : 'slides/about';
            $path   = $file->store($folder, 'public');

            HeroSlide::create([
                'type'       => $type,
                'image'      => $path,
                'title'      => $request->input('title') ?: null,
                'subtitle'   => $request->input('subtitle') ?: null,
                'is_active'  => true,
                'sort_order' => $lastOrder + $i + 1,
            ]);
        }

        $count = count($request->file('images'));
        $label = $type === 'hero' ? 'Foto Beranda' : 'Foto Tentang Kami';

        return back()->with('success', $count . ' ' . $label . ' berhasil diupload.');
    }

    public function update(Request $request, HeroSlide $slide)
    {
        $request->validate([
            'title'    => ['nullable', 'string', 'max:100'],
            'subtitle' => ['nullable', 'string', 'max:200'],
        ]);

        $slide->update([
            'title'     => $request->input('title') ?: null,
            'subtitle'  => $request->input('subtitle') ?: null,
            'is_active' => $request->input('is_active', '0') === '1',
        ]);

        return back()->with('success', 'Slide berhasil diperbarui.');
    }

    public function destroy(HeroSlide $slide)
    {
        Storage::disk('public')->delete($slide->image);
        $slide->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function toggleActive(HeroSlide $slide)
    {
        $slide->update(['is_active' => !$slide->is_active]);
        return back()->with('success', 'Status foto diperbarui.');
    }
}
