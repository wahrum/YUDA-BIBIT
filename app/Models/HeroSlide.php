<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HeroSlide extends Model
{
    protected $fillable = [
        'type',
        'image',
        'title',
        'subtitle',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk foto header beranda
    public function scopeForHero(Builder $query): Builder
    {
        return $query->where('type', 'hero');
    }

    // Scope untuk foto tentang kami
    public function scopeForAbout(Builder $query): Builder
    {
        return $query->where('type', 'about');
    }

    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image);
    }

    public function getTypeLabelAttribute(): string
    {
        return $this->type === 'hero' ? 'Foto Beranda' : 'Foto Tentang Kami';
    }
}
