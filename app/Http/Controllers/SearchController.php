<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\AiSearchService;
use App\Services\ProductSearchService;

class SearchController extends Controller
{
    public function index()
    {
        $products = Product::with(['category'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('search.index', compact('products'));
    }

    /**
     * @param Request $request
     * @param AISearchService $aiService
     * @param ProductSearchService $searchService
     * @return View
     */
    public function search(Request $request, AiSearchService $aiService, ProductSearchService $searchService): View
    {
        $data = $request->validate(['query' => ['required', 'string', 'max:500']]);

        $attributes = $aiService->parseSearchQuery($data['query']);
        $products = $searchService->search($attributes);

        return view('search.results', [
            'products' => $products,
            'query' => $data['query'],
            'attributes' => $attributes,
        ]);
    }
}
