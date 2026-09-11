<?php

namespace App\Filament\Resources\MemorialPages;

use App\Filament\Resources\MemorialPages\Pages\CreateMemorialPage;
use App\Filament\Resources\MemorialPages\Pages\EditMemorialPage;
use App\Filament\Resources\MemorialPages\Pages\ListMemorialPages;
use App\Filament\Resources\MemorialPages\Schemas\MemorialPageForm;
use App\Filament\Resources\MemorialPages\Tables\MemorialPagesTable;
use App\Models\MemorialPage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MemorialPageResource extends Resource
{
    protected static ?string $model = MemorialPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MemorialPageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemorialPagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMemorialPages::route('/'),
            'create' => CreateMemorialPage::route('/create'),
            'edit' => EditMemorialPage::route('/{record}/edit'),
        ];
    }
}
