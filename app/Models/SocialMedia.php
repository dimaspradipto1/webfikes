<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';

    protected $fillable = [
        'nama',
        'logo',
        'icon',
        'url',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan'    => 'integer',
    ];

    /**
     * Get logo asset URL or null
     */
    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo) {
            if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
                return $this->logo;
            }
            if (str_starts_with($this->logo, 'assets/')) {
                return asset($this->logo);
            }
            return asset('storage/' . $this->logo);
        }
        return null;
    }
}
