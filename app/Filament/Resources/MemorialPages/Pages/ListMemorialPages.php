<?php

namespace App\Filament\Resources\MemorialPages\Pages;

use App\Filament\Resources\MemorialPages\MemorialPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMemorialPages extends ListRecords
{
    protected static string $resource = MemorialPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
