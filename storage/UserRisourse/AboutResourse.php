<?php

namespace App\Filament\Resources;

use App\Models\About;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\AboutResource\Pages;

class AboutResource extends Resource
{
    protected static ?string $model = About::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Portfolio';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Select::make('user_id')
                ->relationship('user', 'name')
                ->required()
                ->unique(ignoreRecord: true),

            Textarea::make('description')
                ->rows(4)
                ->nullable(),

            Textarea::make('professional_vision')
                ->label('Professional Vision')
                ->rows(3)
                ->nullable(),

            Textarea::make('mission')
                ->rows(3)
                ->nullable(),

            TextInput::make('location')
                ->maxLength(255)
                ->nullable(),

            DatePicker::make('date_of_birth')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                TextColumn::make('location')
                    ->searchable(),

                TextColumn::make('date_of_birth')
                    ->date(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbouts::route('/'),
            'create' => Pages\CreateAbout::route('/create'),
            'edit' => Pages\EditAbout::route('/{record}/edit'),
        ];
    }
}