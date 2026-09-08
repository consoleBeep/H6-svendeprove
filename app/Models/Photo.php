<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoFactory> */
    use HasFactory;

    protected $fillable = [
        'path',
        'caption',
    ];

    protected function url(): Attribute
    {
        return Attribute::get(fn (): string => Storage::disk('public')->url($this->path));
    }

    public function memorialPage(): BelongsTo
    {
        return $this->belongsTo(MemorialPage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
