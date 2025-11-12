@extends('layouts.app')

@section('content')
<div class="text-center py-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">
        Find Your Perfect Product
    </h1>
    <p class="text-xl text-gray-600 mb-8">
        Try: "red shirt with stripes for summer"
    </p>

    <div class="max-w-2xl mx-auto">
        <form action="{{ route('search') }}" method="GET" class="flex gap-2">
            <input
                type="text"
                name="query"
                placeholder="Describe what you're looking for..."
                class="flex-1 px-6 py-4 text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required
            >
            <button
                type="submit"
                class="px-8 py-4 bg-blue-600 text-white text-lg font-semibold rounded-lg hover:bg-blue-700 transition"
            >
                Search
            </button>
        </form>
    </div>

    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-2">Natural Language</h3>
            <p class="text-gray-600">Search using everyday language</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-2">AI-Powered</h3>
            <p class="text-gray-600">Understands colors, patterns, seasons</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="font-semibold text-lg mb-2">With Images</h3>
            <p class="text-gray-600">See products with their images</p>
        </div>
    </div>
</div>
@endsection
