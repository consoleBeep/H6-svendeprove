<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function memories(): HasMany
    {
        return $this->hasMany(Memory::class)->latest();
    }
}
