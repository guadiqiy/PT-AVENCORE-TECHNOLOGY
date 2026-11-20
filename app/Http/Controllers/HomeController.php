<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->latest()->take(6)->get();
        $categories = Category::withCount('services')->orderBy('name')->get();

        return view('home', compact('services', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
