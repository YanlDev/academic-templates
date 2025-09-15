<?php
namespace Database\Seeders;

use App\Models\Template;
use App\Models\TemplateCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TemplateSeeder extends Seeder
{
    public function run(): void
    {
        $categories = TemplateCategory::all();

        $templates = [
            // Dashboard de Ventas
            [
                'name' => 'Dashboard de Ventas Ejecutivo 2025',
                'description' => 'Dashboard completo con métricas de ventas, análisis de tendencias y KPIs ejecutivos. Incluye gráficos dinámicos, tablas pivote y análisis predictivo para tomar decisiones informadas.',
                'price' => 45.00,
                'difficulty' => 'intermedio',
                'category' => 'dashboards-ventas',
                'featured' => true,
                'features' => [
                    'Gráficos dinámicos interactivos',
                    'Análisis de tendencias mensuales',
                    'KPIs ejecutivos automatizados',
                    'Tablas pivote configurables',
                    'Análisis predictivo de ventas',
                    'Segmentación por productos y regiones'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'https://www.youtube.com/watch?v=oHg5SJYRHA0'
                ],
                'concepts_explanation' => 'Este dashboard utiliza metodologías de Business Intelligence para transformar datos de ventas en insights accionables. Incorpora técnicas de análisis de series temporales, segmentación RFM y modelos de forecasting básicos.'
            ],
            [
                'name' => 'Control de Metas y Comisiones',
                'description' => 'Sistema integral para el seguimiento de metas de ventas, cálculo automático de comisiones y evaluación del desempeño del equipo comercial.',
                'price' => 35.00,
                'difficulty' => 'principiante',
                'category' => 'dashboards-ventas',
                'featured' => false,
                'features' => [
                    'Seguimiento de metas individuales y grupales',
                    'Cálculo automático de comisiones',
                    'Ranking de vendedores',
                    'Alertas de cumplimiento',
                    'Gráficos de progreso en tiempo real'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
                ],
                'concepts_explanation' => 'Basado en metodologías de gestión por objetivos (MBO) y sistemas de compensación variable. Utiliza fórmulas de Excel avanzadas para automatizar cálculos complejos.'
            ],

            // Control Financiero
            [
                'name' => 'Flujo de Caja Proyectado',
                'description' => 'Herramienta profesional para proyección de flujo de caja con escenarios optimista, pesimista y realista. Incluye análisis de sensibilidad y alertas de liquidez.',
                'price' => 55.00,
                'difficulty' => 'avanzado',
                'category' => 'control-financiero',
                'featured' => true,
                'features' => [
                    'Proyección en 3 escenarios',
                    'Análisis de sensibilidad',
                    'Alertas de liquidez automáticas',
                    'Gráficos de tendencias',
                    'Integración con presupuestos',
                    'Reportes ejecutivos automatizados'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'https://www.youtube.com/watch?v=oHg5SJYRHA0'
                ],
                'concepts_explanation' => 'Implementa metodologías de gestión financiera moderna incluyendo análisis de Monte Carlo simplificado, técnicas de forecasting y principios de gestión de riesgo financiero.'
            ],
            [
                'name' => 'Análisis de Rentabilidad por Producto',
                'description' => 'Sistema completo para analizar la rentabilidad por producto, línea de negocio y cliente. Incluye análisis ABC, margen de contribución y punto de equilibrio.',
                'price' => 40.00,
                'difficulty' => 'intermedio',
                'category' => 'control-financiero',
                'featured' => false,
                'features' => [
                    'Análisis ABC de productos',
                    'Cálculo de margen de contribución',
                    'Punto de equilibrio por producto',
                    'Rentabilidad por cliente',
                    'Gráficos de Pareto automatizados'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
                ],
                'concepts_explanation' => 'Basado en principios de contabilidad de gestión y análisis de costos. Utiliza el modelo de costeo ABC y técnicas de análisis de rentabilidad multi-dimensional.'
            ],

            // Gestión de Inventarios
            [
                'name' => 'Control de Stock Inteligente',
                'description' => 'Sistema avanzado de control de inventarios con punto de reorden automático, análisis de rotación y alertas de stock mínimo. Optimiza la gestión de almacenes.',
                'price' => 42.00,
                'difficulty' => 'intermedio',
                'category' => 'gestion-inventarios',
                'featured' => true,
                'features' => [
                    'Punto de reorden automático',
                    'Análisis de rotación de inventarios',
                    'Alertas de stock crítico',
                    'Valorización FIFO/LIFO/Promedio',
                    'Dashboard de KPIs logísticos',
                    'Proyección de demanda'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
                ],
                'concepts_explanation' => 'Implementa modelos de gestión de inventarios como EOQ (Economic Order Quantity), análisis de Pareto para clasificación ABC y técnicas de forecasting de demanda.'
            ],

            // Recursos Humanos
            [
                'name' => 'Evaluación de Desempeño 360°',
                'description' => 'Sistema completo de evaluación de desempeño con metodología 360 grados. Incluye auto-evaluación, evaluación de pares y superiores con análisis estadístico.',
                'price' => 38.00,
                'difficulty' => 'intermedio',
                'category' => 'recursos-humanos',
                'featured' => false,
                'features' => [
                    'Evaluación 360 grados completa',
                    'Escalas de competencias personalizables',
                    'Gráficos de radar por competencia',
                    'Planes de desarrollo automáticos',
                    'Comparativas históricas',
                    'Reportes gerenciales'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
                ],
                'concepts_explanation' => 'Basado en modelos de gestión por competencias y metodologías de evaluación 360°. Incorpora escalas Likert, análisis estadístico descriptivo y frameworks de desarrollo profesional.'
            ],
            [
                'name' => 'Planificador de Nómina Avanzado',
                'description' => 'Sistema integral para cálculo de nómina con todos los conceptos legales peruanos. Incluye CTS, gratificaciones, vacaciones y reportes para SUNAT.',
                'price' => 48.00,
                'difficulty' => 'avanzado',
                'category' => 'recursos-humanos',
                'featured' => true,
                'features' => [
                    'Cálculo automático de todos los conceptos',
                    'CTS y gratificaciones',
                    'Control de vacaciones',
                    'Reportes SUNAT automatizados',
                    'Análisis de costos laborales',
                    'Proyecciones anuales'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'https://www.youtube.com/watch?v=oHg5SJYRHA0'
                ],
                'concepts_explanation' => 'Cumple con la legislación laboral peruana vigente. Implementa fórmulas complejas para cálculo de beneficios sociales según D.S. 001-97-TR y normativas SUNAT.'
            ],

            // Marketing Digital
            [
                'name' => 'Dashboard de Campañas Digitales',
                'description' => 'Centro de control para todas tus campañas de marketing digital. Consolida métricas de Facebook, Google Ads, Instagram y email marketing en un solo lugar.',
                'price' => 44.00,
                'difficulty' => 'intermedio',
                'category' => 'marketing-digital',
                'featured' => true,
                'features' => [
                    'Consolidación multi-plataforma',
                    'ROI y ROAS automático',
                    'Embudo de conversión completo',
                    'Análisis de cohortes',
                    'Atribución de último clic',
                    'Reportes ejecutivos automáticos'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ'
                ],
                'concepts_explanation' => 'Utiliza frameworks de marketing digital como el modelo AIDA, análisis de customer journey y metodologías de atribución multi-touch para optimizar campañas.'
            ],

            // Gestión de Proyectos
            [
                'name' => 'Planificador de Proyectos Gantt',
                'description' => 'Herramienta completa de gestión de proyectos con diagramas de Gantt interactivos, seguimiento de hitos y análisis de ruta crítica.',
                'price' => 50.00,
                'difficulty' => 'avanzado',
                'category' => 'gestion-proyectos',
                'featured' => true,
                'features' => [
                    'Diagramas de Gantt interactivos',
                    'Análisis de ruta crítica',
                    'Seguimiento de hitos',
                    'Gestión de recursos',
                    'Alertas de retrasos',
                    'Dashboard ejecutivo del proyecto'
                ],
                'youtube_videos' => [
                    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'https://www.youtube.com/watch?v=oHg5SJYRHA0'
                ],
                'concepts_explanation' => 'Implementa metodologías PMI y técnicas de Critical Path Method (CPM). Incluye gestión de stakeholders, análisis de riesgos y control de cambios según PMBOK.'
            ]
        ];

        foreach ($templates as $templateData) {
            $category = $categories->where('slug', $templateData['category'])->first();

            if ($category) {
                // Crear imagen principal fake
                $mainImagePath = $this->createFakeImage($templateData['name'], 'main');

                // Crear imágenes de preview fake
                $previewImages = [];
                for ($i = 1; $i <= rand(2, 4); $i++) {
                    $previewImages[] = $this->createFakeImage($templateData['name'] . " Preview $i", 'preview');
                }

                // Crear archivo Excel fake
                $excelPath = $this->createFakeExcelFile($templateData['name']);

                Template::create([
                    'name' => $templateData['name'],
                    'slug' => \Str::slug($templateData['name']),
                    'description' => $templateData['description'],
                    'price' => $templateData['price'],
                    'category_id' => $category->id,
                    'difficulty' => $templateData['difficulty'],
                    'excel_file' => $excelPath,
                    'main_image' => $mainImagePath,
                    'preview_images' => $previewImages,
                    'features' => $templateData['features'],
                    'youtube_videos' => $templateData['youtube_videos'],
                    'concepts_explanation' => $templateData['concepts_explanation'],
                    'sales_content' => $templateData['description'],
                    'tags' => ['excel', 'dashboard', 'profesional'],
                    'downloads' => rand(10, 500),
                    'rating' => round(rand(40, 50) / 10, 1), // 4.0 - 5.0
                    'featured' => $templateData['featured'],
                    'active' => true,
                ]);
            }
        }
    }

    private function createFakeImage($name, $type = 'main'): string
    {
        $width = $type === 'main' ? 800 : 600;
        $height = $type === 'main' ? 600 : 400;

        // Usar servicio de imágenes fake
        $imageUrl = "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 1000);

        try {
            $response = Http::get($imageUrl);

            if ($response->successful()) {
                $filename = \Str::slug($name) . '-' . $type . '-' . time() . '.jpg';
                $path = "templates/{$type}s/{$filename}";

                Storage::disk('public')->put($path, $response->body());
                return $path;
            }
        } catch (\Exception $e) {
            // Fallback: crear imagen simple con colores
            return $this->createSimpleFakeImage($name, $type);
        }

        return $this->createSimpleFakeImage($name, $type);
    }

    private function createSimpleFakeImage($name, $type): string
    {
        $width = $type === 'main' ? 800 : 600;
        $height = $type === 'main' ? 600 : 400;

        // Crear imagen simple con GD
        $image = imagecreate($width, $height);

        // Colores aleatorios
        $bgColor = imagecolorallocate($image, rand(50, 200), rand(50, 200), rand(50, 200));
        $textColor = imagecolorallocate($image, 255, 255, 255);

        // Añadir texto
        $text = substr($name, 0, 20);
        imagestring($image, 5, 10, $height/2, $text, $textColor);

        // Guardar imagen
        $filename = \Str::slug($name) . '-' . $type . '-' . time() . '.png';
        $path = storage_path("app/public/templates/{$type}s/{$filename}");

        // Crear directorio si no existe
        $directory = dirname($path);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        imagepng($image, $path);
        imagedestroy($image);

        return "templates/{$type}s/{$filename}";
    }

    private function createFakeExcelFile($name): string
    {
        $filename = \Str::slug($name) . '-' . time() . '.xlsx';
        $path = "templates/excel/{$filename}";

        // Crear un archivo Excel simple (en realidad será un archivo de texto)
        $content = "Este es un archivo Excel de ejemplo para: {$name}\n";
        $content .= "Creado el: " . now()->format('Y-m-d H:i:s') . "\n";
        $content .= "Descripción: Plantilla profesional de Excel\n";

        Storage::disk('public')->put($path, $content);

        return $path;
    }
}
