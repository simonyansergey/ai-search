<?php
namespace App\Http\Controllers;

use App\Services\AiSearchService;
use App\Services\ProductSearchService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
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
