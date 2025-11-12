@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-900 mb-8">All Products</h1>

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
            <a href="{{ route('products.show', $product) }}">
                <div class="aspect-square bg-gray-200">
                    <img
                        src="{{ $product->image_url }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover"
                        onerror="this.src='https://via.placeholder.com/400x400.png?text=No+Image'"
                    >
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-1">
                        {{ $product->name }}
                    </h3>
                    <p class="text-sm text-gray-500 mb-2">
                        {{ $product->category->name ?? 'Uncategorized' }}
                    </p>
                    <span class="text-lg font-bold text-gray-900">
                        ${{ number_format($product->price, 2) }}
                    </span>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $products->links() }}
</div>
@endsection
