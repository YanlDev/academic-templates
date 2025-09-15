<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class TemplateCategory extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'color', 'sort_order', 'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    // Relaciones
    public function templates()
    {
        return $this->hasMany(Template::class, 'category_id');
    }

    public function activeTemplates()
    {
        return $this->hasMany(Template::class, 'category_id')->where('active', true);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // Accessors
    public function getTemplatesCountAttribute()
    {
        return $this->activeTemplates()->count();
    }

    public function getIconClassAttribute()
    {
        return 'fas fa-' . $this->icon;
    }
}
