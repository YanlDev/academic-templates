<?php
namespace Database\Factories;

use App\Models\Template;
use App\Models\TemplateCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateFactory extends Factory
{
    protected $model = Template::class;

    public function definition(): array
    {
        $difficulties = ['principiante', 'intermedio', 'avanzado'];

        return [
            'name' => $this->faker->sentence(3),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 15, 80),
            'category_id' => TemplateCategory::factory(),
            'difficulty' => $this->faker->randomElement($difficulties),
            'excel_file' => 'templates/excel/example.xlsx',
            'main_image' => 'templates/images/example.jpg',
            'preview_images' => [
                'templates/previews/example1.jpg',
                'templates/previews/example2.jpg',
            ],
            'features' => [
                'Gráficos dinámicos',
                'Fórmulas avanzadas',
                'Dashboard interactivo',
            ],
            'youtube_videos' => [
                'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            'concepts_explanation' => $this->faker->paragraph(2),
            'sales_content' => $this->faker->paragraph(4),
            'tags' => ['excel', 'dashboard', 'profesional'],
            'downloads' => $this->faker->numberBetween(0, 1000),
            'rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'featured' => $this->faker->boolean(20), // 20% chance
            'active' => true,
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'active' => false,
        ]);
    }
}
