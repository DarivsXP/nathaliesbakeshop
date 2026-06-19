<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MenuController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $categories = Category::query()
            ->orderBy('sort_order')
            ->get(['id', 'name', 'slug']);

        $products = Product::query()
            ->with('category')
            ->where('is_active', true)
            ->when($request->category, function ($query, $category) {
                $query->whereHas('category', fn ($q) => $q->where('slug', $category));
            })
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->get();

        return Inertia::render('Shop/Menu', [
            'categories' => $categories,
            'products' => $products,
            'filters' => [
                'category' => $request->category,
                'search' => $request->search,
            ],
        ]);
    }
}
