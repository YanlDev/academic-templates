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
        // SOLUCIÓN: Procesar el textarea de características antes de la validación
        $this->preprocessFormData($request);

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
    public function show(Template $template)
    {
        return view('admin.templates.show', compact('template'));
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
        // SOLUCIÓN: Procesar el textarea de características antes de la validación
        $this->preprocessFormData($request);

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
        // Opcional: Eliminar archivos físicos antes de eliminar el registro
        $this->deleteTemplateFiles($template);

        $template->delete();

        return redirect()->route('admin.templates.index')
            ->with('success', 'Plantilla eliminada exitosamente.');
    }

    /**
     * NUEVA FUNCIÓN: Preprocesat los datos del formulario
     * Convierte los textarea en arrays para la validación
     */
    private function preprocessFormData(Request $request)
    {
        // Procesar características desde textarea a array
        if ($request->has('features_text')) {
            $featuresText = $request->input('features_text');
            $features = array_filter(
                array_map('trim', explode("\n", $featuresText)),
                function($feature) {
                    return !empty($feature);
                }
            );
            $request->merge(['features' => $features]);
        }

        // Procesar videos de YouTube desde textarea a array
        if ($request->has('youtube_videos_text')) {
            $videosText = $request->input('youtube_videos_text');
            $videos = array_filter(
                array_map('trim', explode("\n", $videosText)),
                function($video) {
                    return !empty($video);
                }
            );
            $request->merge(['youtube_videos' => $videos]);
        }
    }

    /**
     * NUEVA FUNCIÓN: Eliminar archivos físicos de una plantilla
     */
    private function deleteTemplateFiles(Template $template)
    {
        $storage = \Storage::disk('public');

        // Eliminar archivo Excel
        if ($template->excel_file && $storage->exists($template->excel_file)) {
            $storage->delete($template->excel_file);
        }

        // Eliminar imagen principal
        if ($template->main_image && $storage->exists($template->main_image)) {
            $storage->delete($template->main_image);
        }

        // Eliminar imágenes de preview
        if ($template->preview_images && is_array($template->preview_images)) {
            foreach ($template->preview_images as $previewImage) {
                if ($storage->exists($previewImage)) {
                    $storage->delete($previewImage);
                }
            }
        }
    }

    /**
     * NUEVA FUNCIÓN: Activar/Desactivar una plantilla
     */
    public function toggleStatus(Template $template)
    {
        $template->update(['active' => !$template->active]);

        $status = $template->active ? 'activada' : 'desactivada';

        return redirect()->route('admin.templates.index')
            ->with('success', "Plantilla {$status} exitosamente.");
    }

    /**
     * NUEVA FUNCIÓN: Marcar/Desmarcar como destacada
     */
    public function toggleFeatured(Template $template)
    {
        $template->update(['featured' => !$template->featured]);

        $status = $template->featured ? 'marcada como destacada' : 'desmarcada como destacada';

        return redirect()->route('admin.templates.index')
            ->with('success', "Plantilla {$status} exitosamente.");
    }

    /**
     * NUEVA FUNCIÓN: Duplicar una plantilla
     */
    public function duplicate(Template $template)
    {
        $newTemplate = $template->replicate();
        $newTemplate->name = $template->name . ' (Copia)';
        $newTemplate->slug = Str::slug($newTemplate->name);
        $newTemplate->featured = false;
        $newTemplate->active = false;
        $newTemplate->downloads = 0;
        $newTemplate->rating = 0;
        $newTemplate->save();

        return redirect()->route('admin.templates.edit', $newTemplate)
            ->with('success', 'Plantilla duplicada exitosamente. Recuerda subir nuevos archivos.');
    }

    /**
     * NUEVA FUNCIÓN: Estadísticas básicas
     */
    public function stats()
    {
        $stats = [
            'total_templates' => Template::count(),
            'active_templates' => Template::where('active', true)->count(),
            'featured_templates' => Template::where('featured', true)->count(),
            'total_downloads' => Template::sum('downloads'),
            'categories_with_templates' => TemplateCategory::has('templates')->count(),
            'average_rating' => Template::where('rating', '>', 0)->avg('rating'),
            'recent_templates' => Template::latest()->take(5)->get(),
            'top_templates' => Template::orderBy('downloads', 'desc')->take(5)->get(),
        ];

        return view('admin.templates.stats', compact('stats'));
    }
}
