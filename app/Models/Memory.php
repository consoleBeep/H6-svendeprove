<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Memory extends Model
{
    /** @use HasFactory<\Database\Factories\MemoryFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public function memorialPage(): BelongsTo
    {
        return $this->belongsTo(MemorialPage::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
