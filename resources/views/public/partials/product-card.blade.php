<article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md border border-gray-100 transition-all duration-200 group">
    <a href="{{ route('product.detail', $product->slug) }}" class="block">
        <div class="aspect-square overflow-hidden bg-primary-50">
            @if($product->image)
                <img src="{{ $product->image_url }}"
                     alt="{{ $product->name }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
                <div class="w-full h-full flex items-center justify-center">
                    <span class="text-6xl">🌿</span>
                </div>
            @endif
        </div>
    </a>

    <div class="p-4">
        @if($product->is_featured)
            <span class="inline-block bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded-full mb-2">⭐ Unggulan</span>
        @endif

        <p class="text-xs text-gray-400 mb-1">{{ $product->category->name ?? '' }}</p>

        <a href="{{ route('product.detail', $product->slug) }}">
            <h3 class="font-semibold text-forest hover:text-primary-700 transition line-clamp-2 leading-snug mb-2">
                {{ $product->name }}
            </h3>
        </a>

        @if($product->short_description)
            <p class="text-gray-500 text-xs line-clamp-2 mb-3">{{ $product->short_description }}</p>
        @endif

        <div class="flex items-center justify-between mt-auto">
            <span class="font-bold text-forest text-sm">{{ $product->formatted_price }}</span>
            @if($product->price)
                <span class="text-xs text-gray-400">/ {{ $product->unit }}</span>
            @endif
        </div>

        @php $waNumber = \App\Models\SiteSetting::get('site_whatsapp', ''); @endphp
        @if($waNumber)
            <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo, saya tertarik dengan produk: ' . $product->name) }}"
               target="_blank"
               class="mt-3 flex items-center justify-center gap-2 w-full bg-green-50 hover:bg-green-500 text-green-600 hover:text-white border border-green-200 hover:border-green-500 text-xs font-semibold py-2 rounded-xl transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 32 32" fill="currentColor">
                    <path d="M16.003 2.667C8.64 2.667 2.667 8.64 2.667 16c0 2.373.624 4.699 1.813 6.752L2.667 29.333l6.752-1.771A13.3 13.3 0 0016.003 29.333c7.36 0 13.33-5.973 13.33-13.333S23.363 2.667 16.003 2.667zm6.035 16.432c-.33-.165-1.952-.963-2.255-1.072-.304-.11-.525-.165-.747.165s-.856 1.072-1.05 1.293c-.193.22-.385.247-.716.083-.33-.165-1.395-.514-2.658-1.64-.981-.873-1.645-1.953-1.838-2.283-.193-.33-.021-.509.145-.673.149-.148.33-.385.495-.578.165-.193.22-.33.33-.55.11-.22.055-.413-.027-.578-.083-.165-.747-1.8-1.023-2.466-.27-.648-.543-.56-.747-.57l-.637-.011a1.22 1.22 0 00-.885.413c-.303.33-1.157 1.13-1.157 2.757s1.185 3.198 1.35 3.418c.165.22 2.332 3.563 5.65 4.994.79.34 1.406.543 1.886.695.793.25 1.515.215 2.086.13.636-.094 1.952-.798 2.228-1.568.275-.77.275-1.43.193-1.568-.082-.138-.303-.22-.633-.385z"/>
                </svg>
                Tanya via WA
            </a>
        @endif
    </div>
</article>
