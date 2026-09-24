<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemorialPageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'birth_date' => $this->birth_date?->format('Y-m-d'),
            'birth_place' => $this->birth_place,
            'death_date' => $this->death_date?->format('Y-m-d'),
            'death_place' => $this->death_place,
            'grave_location' => $this->grave_location,
            'life_story' => $this->life_story,
            'portrait_url' => $this->portrait_url,
            'url' => route('memorial-pages.show', $this->resource),
        ];
    }
}
