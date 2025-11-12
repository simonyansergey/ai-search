@extends('layouts.app')

@section('content')
<div class="mb-8">
    <form action="{{ route('search') }}" method="GET" class="flex gap-2">
        <input
            type="text"
            name="q"
            value="{{ $query }}"
            placeholder="Describe what you're looking for..."
            class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
            required
        >
        <button
            type="submit"
            class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700"
        >
            Search
        </button>
    </form>
</div>

<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-900">
        Search Results for "{{ $query }}"
    </h2>
    <p class="text-gray-600 mt-1">
        Found {{ $products->count() }} {{ Str::plural('product', $products->count()) }}
    </p>

    @if(config('app.debug'))
    <details class="mt-4 bg-gray-100 p-4 rounded text-sm">
        <summary class="cursor-pointer font-semibold">AI Understanding (Debug)</summary>
        <pre class="mt-2">{{ json_encode($attributes, JSON_PRETTY_PRINT) }}</pre>
    </details>
    @endif
</div>

@if($products->isEmpty())
    <div class="text-center py-12 bg-white rounded-lg shadow">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No products found</h3>
        <p class="mt-2 text-gray-500">Try different keywords or browse all products</p>
        <a href="{{ route('products.index') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            View All Products
        </a>
    </div>
@else
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
                        <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">
                            {{ $product->name }}
                        </h3>
                        <p class="text-sm text-gray-500 mb-2">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-900">
                                ${{ number_format($product->price, 2) }}
                            </span>
                            @if($product->color)
                            <span class="px-2 py-1 bg-gray-100 text-xs rounded">
                                {{ ucfirst($product->color) }}
                            </span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif
@endsection
