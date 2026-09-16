<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class MemorialPage extends Model
{
    /** @use HasFactory<\Database\Factories\MemorialPageFactory> */
    use HasFactory;

    protected $fillable = [
        'full_name',
        'birth_date',
        'birth_place',
        'death_date',
        'death_place',
        'grave_location',
        'life_story',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'death_date' => 'date',
        ];
    }

    protected function portraitUrl(): Attribute
    {
        return Attribute::get(fn (): ?string => $this->profile_photo_path
            ? Storage::disk('public')->url($this->profile_photo_path)
            : null);
    }

    protected function lifespan(): Attribute
    {
        return Attribute::get(function (): ?string {
            $birthYear = $this->birth_date?->format('Y');
            $deathYear = $this->death_date?->format('Y');

            return match (true) {
                $birthYear && $deathYear => "{$birthYear}–{$deathYear}",
                default => $birthYear ?? $deathYear,
            };
        });
    }

    // raw LOWER()/LIKE so this behaves the same on sqlite (tests) and postgres (prod)
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        return $query->whereRaw('lower(full_name) like ?', ['%'.mb_strtolower($term).'%']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function memories(): HasMany
    {
        return $this->hasMany(Memory::class)->latest();
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class)->latest();
    }
}
