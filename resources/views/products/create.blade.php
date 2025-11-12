@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-8 border border-gray-100">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 flex items-center gap-2">
        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4v16m8-8H4" />
        </svg>
        Add New Product
    </h1>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Product name --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        {{-- Category --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
            <select name="category_id"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                <option value="">— Select Category —</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Price --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Price ($)</label>
            <input type="number" name="price" step="0.01" value="{{ old('price') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
            <textarea name="description" rows="4"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description') }}</textarea>
        </div>

        {{-- Image --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Image</label>
            <input type="file" name="image"
                class="block w-full border border-gray-300 text-gray-700 rounded-lg cursor-pointer bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        {{-- Extra attributes --}}
        <div class="grid grid-cols-2 gap-4">
            @foreach (['color' => 'Color', 'pattern' => 'Pattern', 'season' => 'Season', 'material' => 'Material'] as $name => $label)
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">{{ $label }}</label>
                    <input type="text" name="{{ $name }}" value="{{ old($name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            @endforeach
        </div>

        {{-- Size --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Size</label>
            <input type="text" name="size" value="{{ old('size') }}"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end pt-4">
            <a href="{{ route('home') }}"
                class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition mr-3">
                Cancel
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow-sm transition">
                Create Product
            </button>
        </div>
    </form>
</div>
@endsection
