<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\TemplateCategory;

class HomeController extends Controller
{
    public function index()
    {
        $featuredTemplates = Template::where('active', true)
            ->where('featured', true)
            ->with('category')
            ->take(8)
            ->get();

        $popularCategories = TemplateCategory::where('active', true)
            ->withCount('templates')
            ->orderBy('templates_count', 'desc')
            ->take(6)
            ->get();

        $stats = [
            'templates_count' => Template::where('active', true)->count(),
            'downloads_count' => Template::sum('downloads'),
            'categories_count' => TemplateCategory::where('active', true)->count(),
            'users_count' => \App\Models\User::count(),
        ];

        return view('public.home.index', compact(
            'featuredTemplates',
            'popularCategories',
            'stats'
        ));
    }
}
