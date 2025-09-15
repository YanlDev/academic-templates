<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\TemplateCategory;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $categories = TemplateCategory::active()->orderBy('sort_order')->get();
        $featuredTemplates = Template::featured()->active()->limit(6)->get();
        $recentTemplates = Template::active()->latest()->limit(8)->get();

        return view('templates.index', compact('categories', 'featuredTemplates', 'recentTemplates'));
    }

    public function show(Template $template)
    {
        // Incrementar vistas (opcional)
        $relatedTemplates = Template::active()
            ->where('category_id', $template->category_id)
            ->where('id', '!=', $template->id)
            ->limit(4)
            ->get();

        return view('templates.show', compact('template', 'relatedTemplates'));
    }

    public function category(TemplateCategory $category)
    {
        $templates = $category->templates()
            ->active()
            ->paginate(12);

        return view('templates.category', compact('category', 'templates'));
    }
}
