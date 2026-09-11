<?php

namespace App\Filament\Resources\MemorialPages\Pages;

use App\Filament\Resources\MemorialPages\MemorialPageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMemorialPage extends EditRecord
{
    protected static string $resource = MemorialPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
