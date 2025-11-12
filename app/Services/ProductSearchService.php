<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductSearchService
{
    /**
     * @param array $attributes
     * @return Collection
     */
    public function search(array $attributes): Collection
    {
        return Product::with(['category'])
            ->when(!empty($attributes['category']), function ($query) use ($attributes) {
                $query->whereHas('category', function($q) use ($attributes) {
                    $q->where('slug', $attributes['category']);
                });
            })
            ->when(!empty($attributes['color']), function ($query) use ($attributes) {
                $query->where('color', $attributes['color']);
            })
            ->when(!empty($attributes['pattern']), function ($query) use ($attributes) {
                $query->where('pattern', $attributes['pattern']);
            })
            ->when(!empty($attributes['season']), function ($query) use ($attributes) {
                $query->where(function($q) use ($attributes) {
                    $q->where('season', $attributes['season'])
                        ->orWhere('season', 'all-season');
                });
            })
            ->when(!empty($attributes['material']), function ($query) use ($attributes) {
                $query->where('material', $attributes['material']);
            })
            ->when(!empty($attributes['keywords']), function ($query) use ($attributes) {
                $query->where(function($q) use ($attributes) {
                    foreach ($attributes['keywords'] as $keyword) {
                        $q->whereLike('name', "%{$keyword}%")
                            ->orWhereLike('description', "%{$keyword}%");
                    }
                });
            })
            ->get();
    }
}
