@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
        <div>
            <img
                src="{{ $product->image_url }}"
                alt="{{ $product->name }}"
                class="w-full rounded-lg"
                onerror="this.src='https://via.placeholder.com/600x600.png?text=No+Image'"
            >
        </div>

        <div>
            <div class="mb-2">
                <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">
                    ← Back to products
                </a>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">
                {{ $product->name }}
            </h1>

            <div class="mb-4">
                <span class="text-3xl font-bold text-gray-900">
                    ${{ number_format($product->price, 2) }}
                </span>
            </div>

            <div class="mb-6 space-y-2">
                @if($product->category)
                <p><span class="font-semibold">Category:</span> {{ $product->category->name }}</p>
                @endif
                @if($product->color)
                <p><span class="font-semibold">Color:</span> {{ ucfirst($product->color) }}</p>
                @endif
                @if($product->pattern)
                <p><span class="font-semibold">Pattern:</span> {{ ucfirst($product->pattern) }}</p>
                @endif
                @if($product->season)
                <p><span class="font-semibold">Season:</span> {{ ucfirst($product->season) }}</p>
                @endif
                @if($product->material)
                <p><span class="font-semibold">Material:</span> {{ ucfirst($product->material) }}</p>
                @endif
                @if($product->size)
                <p><span class="font-semibold">Size:</span> {{ $product->size }}</p>
                @endif
            </div>

            <div class="mb-6">
                <h2 class="font-semibold text-lg mb-2">Description</h2>
                <p class="text-gray-700">{{ $product->description }}</p>
            </div>

            <button class="w-full px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                Add to Cart
            </button>
        </div>
    </div>
</div>
@endsection
