<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'serviceCount'  => Service::count(),
            'categoryCount' => Category::count(),
            'latest'        => Service::with('category')->latest()->take(5)->get(),
        ]);
    }
}
