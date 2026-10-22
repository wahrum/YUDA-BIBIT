<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HeroSlide;
use App\Models\Product;
use App\Models\SiteSetting;

class PublicController extends Controller
{
    /**
     * Halaman utama / landing page.
     */
    public function index()
    {
        $slides = HeroSlide::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $heroSlides = $slides->where('type', 'hero')->values();
        $aboutSlides = $slides->where('type', 'about')->values();

        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::withCount(['activeProducts'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(6)
            ->get();

        return view('public.home', compact('slides', 'heroSlides', 'aboutSlides', 'featuredProducts', 'categories', 'latestProducts'));
    }

    /**
     * Halaman daftar semua produk, bisa filter per kategori.
     */
    public function products()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $query = Product::with('category');

        if (request('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', request('category')));
        }

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        $products = $query->orderBy('name')->paginate(12);

        $activeCategory = request('category')
            ? $categories->firstWhere('slug', request('category'))
            : null;

        return view('public.products', compact('products', 'categories', 'activeCategory'));
    }

    /**
     * Halaman detail produk.
     */
    public function productDetail(string $slug)
    {
        $product = Product::with(['category', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('public.product-detail', compact('product', 'relatedProducts'));
    }
}
