<?php
namespace Database\Factories;

use App\Models\TemplateCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TemplateCategoryFactory extends Factory
{
    protected $model = TemplateCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'slug' => $this->faker->slug,
            'description' => $this->faker->sentence,
            'icon' => $this->faker->randomElement(['chart-bar', 'currency-dollar', 'archive', 'users']),
            'color' => $this->faker->hexColor,
            'sort_order' => $this->faker->numberBetween(1, 100),
            'active' => true,
        ];
    }
}
