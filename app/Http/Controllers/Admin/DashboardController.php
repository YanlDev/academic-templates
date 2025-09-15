<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateCategory;
use App\Models\Template;

class DashboardController extends Controller
{
    public function index()
    {
        $categoriesCount = TemplateCategory::count();
        $templatesCount = Template::count();
        $activeTemplates = Template::active()->count();

        return view('admin.dashboard', compact('categoriesCount', 'templatesCount', 'activeTemplates'));
    }
}
