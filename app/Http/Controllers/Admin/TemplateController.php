<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\TemplateCategory;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::with('category')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TemplateCategory::active()->orderBy('sort_order')->get();
        return view('admin.templates.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:template_categories,id',
            'excel_file' => 'required|mimes:xlsx,xls|max:10240', // 10MB
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'preview_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'difficulty' => 'required|in:principiante,intermedio,avanzado',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string|max:255',
            'youtube_videos' => 'nullable|array',
            'youtube_videos.*' => 'nullable|url',
            'concepts_explanation' => 'nullable|string',
            'active' => 'required|boolean'
        ]);
        // Upload Excel file
        $excelFile = $request->file('excel_file');
        $excelPath = $excelFile->store('templates/excel', 'public');

        // Upload main image
        $mainImage = $request->file('main_image');
        $mainImagePath = $mainImage->store('templates/images', 'public');

        // Process and upload preview images
        $previewImages = [];
        if ($request->hasFile('preview_images')) {
            foreach ($request->file('preview_images') as $image) {
                $path = $image->store('templates/previews', 'public');
                $previewImages[] = $path;
            }
        }

        // Limpiar y preparar los datos JSON
        $features = array_filter($request->features ?? [], function($feature) {
            return !empty(trim($feature));
        });

        $youtubeVideos = array_filter($request->youtube_videos ?? [], function($video) {
            return !empty(trim($video)) && (strpos($video, 'youtube.com') !== false || strpos($video, 'youtu.be') !== false);
        });

        Template::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'excel_file' => $excelPath,
            'main_image' => $mainImagePath,
            'preview_images' => $previewImages,
            'difficulty' => $request->difficulty,
            'features' => $features,
            'youtube_videos' => $youtubeVideos,
            'concepts_explanation' => $request->concepts_explanation,
            'sales_content' => $request->description, // Por ahora usar la descripción
            'tags' => $request->tags ?? [],
            'active' => $request->active,
            'featured' => false
        ]);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Plantilla creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        $categories = TemplateCategory::active()->orderBy('sort_order')->get();

        return view('admin.templates.edit', compact('template', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:template_categories,id',
            'excel_file' => 'nullable|mimes:xlsx,xls|max:10240',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'preview_images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'difficulty' => 'required|in:principiante,intermedio,avanzado',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string|max:255',
            'youtube_videos' => 'nullable|array',
            'youtube_videos.*' => 'nullable|url',
            'concepts_explanation' => 'nullable|string',
            'active' => 'required|boolean'
        ]);

        // Limpiar y preparar los datos JSON
        $features = array_filter($request->features ?? [], function($feature) {
            return !empty(trim($feature));
        });

        $youtubeVideos = array_filter($request->youtube_videos ?? [], function($video) {
            return !empty(trim($video)) && (strpos($video, 'youtube.com') !== false || strpos($video, 'youtu.be') !== false);
        });

        $updateData = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'difficulty' => $request->difficulty,
            'features' => $features,
            'youtube_videos' => $youtubeVideos,
            'concepts_explanation' => $request->concepts_explanation,
            'active' => $request->active
        ];

        // Handle file uploads only if new files are provided
        if ($request->hasFile('excel_file')) {
            $excelFile = $request->file('excel_file');
            $updateData['excel_file'] = $excelFile->store('templates/excel', 'public');
        }

        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $updateData['main_image'] = $mainImage->store('templates/images', 'public');
        }

        if ($request->hasFile('preview_images')) {
            $previewImages = [];
            foreach ($request->file('preview_images') as $image) {
                $path = $image->store('templates/previews', 'public');
                $previewImages[] = $path;
            }
            $updateData['preview_images'] = $previewImages;
        }

        $template->update($updateData);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Plantilla actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        $template->delete();

        return redirect()->route('admin.templates.index')
            ->with('success', 'Plantilla eliminada exitosamente.');
    }
}
