<?php
// database/seeders/TemplateCategorySeeder.php

namespace Database\Seeders;

use App\Models\TemplateCategory;
use Illuminate\Database\Seeder;

class TemplateCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Dashboards de Ventas',
                'slug' => 'dashboards-ventas',
                'description' => 'Plantillas para crear dashboards profesionales de ventas con KPIs y métricas clave',
                'icon' => 'chart-bar',
                'color' => '#3B82F6',
                'sort_order' => 1,
                'active' => true,
            ],
            [
                'name' => 'Control Financiero',
                'slug' => 'control-financiero',
                'description' => 'Herramientas para el control y análisis financiero empresarial',
                'icon' => 'currency-dollar',
                'color' => '#10B981',
                'sort_order' => 2,
                'active' => true,
            ],
            [
                'name' => 'Gestión de Inventarios',
                'slug' => 'gestion-inventarios',
                'description' => 'Sistemas de control y gestión de inventarios y almacenes',
                'icon' => 'archive',
                'color' => '#F59E0B',
                'sort_order' => 3,
                'active' => true,
            ],
            [
                'name' => 'Recursos Humanos',
                'slug' => 'recursos-humanos',
                'description' => 'Plantillas para gestión de personal, nóminas y evaluaciones',
                'icon' => 'users',
                'color' => '#8B5CF6',
                'sort_order' => 4,
                'active' => true,
            ],
            [
                'name' => 'Marketing Digital',
                'slug' => 'marketing-digital',
                'description' => 'Herramientas para análisis y seguimiento de campañas de marketing',
                'icon' => 'megaphone',
                'color' => '#EF4444',
                'sort_order' => 5,
                'active' => true,
            ],
            [
                'name' => 'Gestión de Proyectos',
                'slug' => 'gestion-proyectos',
                'description' => 'Plantillas para planificación y seguimiento de proyectos',
                'icon' => 'clipboard-list',
                'color' => '#06B6D4',
                'sort_order' => 6,
                'active' => true,
            ],
        ];

        foreach ($categories as $category) {
            TemplateCategory::create($category);
        }
    }
}
