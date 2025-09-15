<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin', // Agregar este campo
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean', // Agregar este cast
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    // Relaciones
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function downloadLogs()
    {
        return $this->hasMany(DownloadLog::class);
    }

    // Scopes
    public function scopeAdmins($query)
    {
        return $query->where('is_admin', true);
    }

    public function scopeCustomers($query)
    {
        return $query->where('is_admin', false);
    }

    // Methods
    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function getTotalPurchasesAttribute()
    {
        return $this->purchases()->where('status', 'completed')->sum('amount');
    }

    public function getPurchasedTemplatesAttribute()
    {
        return $this->purchases()
            ->where('status', 'completed')
            ->with('template')
            ->get()
            ->pluck('template');
    }
}
