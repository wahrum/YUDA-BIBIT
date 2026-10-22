<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active'   => ['nullable'],
        ]);

        $data = [
            'name'        => $request->input('name'),
            'slug'        => Str::slug($request->input('name')),
            'description' => $request->input('description') ?: null,
            'is_active'   => $request->input('is_active', '0') === '1',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active'   => ['nullable'],
        ]);

        $data = [
            'name'        => $request->input('name'),
            'slug'        => Str::slug($request->input('name')),
            'description' => $request->input('description') ?: null,
            'is_active'   => $request->input('is_active', '0') === '1',
        ];

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori "' . $category->fresh()->name . '" berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        // Hapus semua foto produk dalam kategori ini dari storage
        foreach ($category->products()->with('images')->get() as $product) {
            // Hapus foto galeri
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->image);
            }
            // Hapus foto utama
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
        }

        // Hapus foto kategori
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        // Hapus kategori — produk ikut terhapus otomatis (cascade)
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori dan semua produknya berhasil dihapus.');
    }
}
