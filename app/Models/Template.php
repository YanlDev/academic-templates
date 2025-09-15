<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Template extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'category_id',
        'excel_file', 'main_image', 'preview_images', 'difficulty',
        'features', 'youtube_videos', 'concepts_explanation',
        'sales_content', 'tags', 'downloads', 'rating',
        'featured', 'active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'preview_images' => 'array',
        'features' => 'array',
        'youtube_videos' => 'array',
        'tags' => 'array',
        'rating' => 'decimal:1',
        'featured' => 'boolean',
        'active' => 'boolean'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    // Relaciones
    public function category()
    {
        return $this->belongsTo(TemplateCategory::class, 'category_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function downloadLogs()
    {
        return $this->hasMany(DownloadLog::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return 'S/ ' . number_format($this->price, 2);
    }

    public function getMainImageUrlAttribute()
    {
        return $this->main_image ? asset('storage/' . $this->main_image) : asset('images/no-image.png');
    }

    public function getExcelFileUrlAttribute()
    {
        return $this->excel_file ? asset('storage/' . $this->excel_file) : null;
    }

    public function getPreviewImageUrlsAttribute()
    {
        if (!$this->preview_images) return [];

        return collect($this->preview_images)->map(function ($image) {
            return asset('storage/' . $image);
        })->toArray();
    }

    public function getDifficultyBadgeAttribute()
    {
        $badges = [
            'principiante' => ['color' => 'green', 'text' => 'Principiante'],
            'intermedio' => ['color' => 'yellow', 'text' => 'Intermedio'],
            'avanzado' => ['color' => 'red', 'text' => 'Avanzado'],
        ];

        return $badges[$this->difficulty] ?? $badges['intermedio'];
    }

    public function getRatingStarsAttribute()
    {
        $fullStars = floor($this->rating);
        $halfStar = ($this->rating - $fullStars) >= 0.5;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

        return [
            'full' => $fullStars,
            'half' => $halfStar ? 1 : 0,
            'empty' => $emptyStars
        ];
    }
}
