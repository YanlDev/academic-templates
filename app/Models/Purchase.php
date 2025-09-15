<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'code', 'user_id', 'template_id', 'transaction_id',
        'amount', 'payment_method', 'status', 'downloads_used', 'downloads_limit'
    ];

    protected $casts = [
        'amount' => 'decimal:2'
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function downloadLogs()
    {
        return $this->hasMany(DownloadLog::class);
    }

    // Scopes
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Methods
    public function canDownload()
    {
        return $this->status === 'completed' && $this->downloads_used < $this->downloads_limit;
    }
}
