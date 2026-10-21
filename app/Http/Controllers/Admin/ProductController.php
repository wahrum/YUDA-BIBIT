<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => ['required', 'exists:categories,id'],
            'name'              => ['required', 'string', 'max:200'],
            'short_description' => ['nullable', 'string', 'max:300'],
            'description'       => ['nullable', 'string'],
            'price'             => ['nullable', 'string'],  // string dulu, konversi manual
            'unit'              => ['required', 'string', 'max:50'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'is_active'         => ['nullable'],
            'is_featured'       => ['nullable'],
            'gallery.*'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        $data = [
            'category_id'       => $request->input('category_id'),
            'name'              => $request->input('name'),
            'slug'              => Str::slug($request->input('name')),
            'short_description' => $request->input('short_description') ?: null,
            'description'       => $request->input('description') ?: null,
            'price'             => $request->filled('price') ? (float) $request->input('price') : null,
            'unit'              => $request->input('unit'),
            'is_active'         => $request->input('is_active', '0') === '1',
            'is_featured'       => $request->input('is_featured', '0') === '1',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $i => $file) {
                $path = $file->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $product->name . '" berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'       => ['required', 'exists:categories,id'],
            'name'              => ['required', 'string', 'max:200'],
            'short_description' => ['nullable', 'string', 'max:300'],
            'description'       => ['nullable', 'string'],
            'price'             => ['nullable', 'string'],  // string dulu, konversi manual
            'unit'              => ['required', 'string', 'max:50'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'is_active'         => ['nullable'],
            'is_featured'       => ['nullable'],
            'gallery.*'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ]);

        // Bangun array data secara eksplisit — tidak pakai $validated agar tidak ada field asing
        $data = [
            'category_id'       => $request->input('category_id'),
            'name'              => $request->input('name'),
            'slug'              => Str::slug($request->input('name')),
            'short_description' => $request->input('short_description') ?: null,
            'description'       => $request->input('description') ?: null,
            'price'             => $request->filled('price') ? (float) $request->input('price') : null,
            'unit'              => $request->input('unit'),
            'is_active'         => $request->input('is_active', '0') === '1',
            'is_featured'       => $request->input('is_featured', '0') === '1',
        ];

        // Update foto utama hanya jika ada file baru
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // Simpan galeri foto baru
        if ($request->hasFile('gallery')) {
            $lastOrder = $product->images()->max('sort_order') ?? 0;
            foreach ($request->file('gallery') as $i => $file) {
                $path = $file->store('products/gallery', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image'      => $path,
                    'sort_order' => $lastOrder + $i + 1,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk "' . $product->fresh()->name . '" berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image);
            $img->delete();
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function destroyImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }
}
