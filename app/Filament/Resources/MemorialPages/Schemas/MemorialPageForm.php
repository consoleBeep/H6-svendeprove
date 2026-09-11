<?php

namespace App\Filament\Resources\MemorialPages\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MemorialPageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Owner')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('full_name')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('profile_photo_path')
                    ->label('Profile photo')
                    ->image()
                    ->avatar()
                    ->disk('public')
                    ->directory('portraits')
                    ->columnSpanFull(),
                DatePicker::make('birth_date'),
                TextInput::make('birth_place'),
                DatePicker::make('death_date'),
                TextInput::make('death_place'),
                TextInput::make('grave_location')
                    ->columnSpanFull(),
                Textarea::make('life_story')
                    ->rows(8)
                    ->columnSpanFull(),
            ]);
    }
}
