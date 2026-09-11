<?php

namespace App\Filament\Resources\Memories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MemoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('memorial_page_id')
                    ->relationship('memorialPage', 'full_name')
                    ->searchable()
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('title'),
                Textarea::make('content')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
