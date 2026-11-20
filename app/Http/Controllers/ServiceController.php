<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('services')->orderBy('name')->get();
        $activeCategory = $request->query('kategori');
        $keyword = trim((string) $request->query('q', ''));

        $services = Service::with('category')
            ->when($activeCategory, fn ($q) => $q->whereHas(
                'category',
                fn ($c) => $c->where('slug', $activeCategory)
            ))
            ->when($keyword !== '', fn ($q) => $q->where(function ($w) use ($keyword) {
                $w->where('name', 'like', "%{$keyword}%")
                  ->orWhere('summary', 'like', "%{$keyword}%");
            }))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return view('services.index', compact('services', 'categories', 'activeCategory', 'keyword'));
    }

    public function show(Service $service)
    {
        $service->load('category');

        $related = Service::with('category')
            ->where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->latest()
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'related'));
    }
}
