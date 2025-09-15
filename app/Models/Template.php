<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Template extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'excel_file',
        'preview_images', 'main_image', 'sales_content',
        'features', 'youtube_videos', 'concepts_explanation',
        'category_id', 'difficulty', 'tags', 'featured', 'active'
    ];

    protected $casts = [
        'preview_images' => 'array',
        'features' => 'array',
        'youtube_videos' => 'array',
        'tags' => 'array',
        'featured' => 'boolean',
        'active' => 'boolean',
        'price' => 'decimal:2',
        'rating' => 'decimal:2'
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

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return 'S/ ' . number_format($this->price, 2);
    }

    public function getMainImageUrlAttribute()
    {
        return asset('storage/' . $this->main_image);
    }
}
