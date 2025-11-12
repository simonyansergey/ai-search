<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $products = Product::with(['category'])->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view('products.show', compact('product'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * @param ProductStoreRequest $request
     * @return void
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()
            ->route('home')
            ->with('success', 'Product created!');
    }
}
