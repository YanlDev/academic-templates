<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DownloadLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id', 'ip_address', 'downloaded_at'
    ];

    protected $casts = [
        'downloaded_at' => 'datetime'
    ];

    // Relaciones
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
