<?php

namespace App\Filament\Resources;

use App\Models\Contact;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use App\Filament\Resources\ContactResource\Pages;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationGroup = 'Portfolio Management';

    public static function form(Form $form): Form
    {
        return $form->schema([

            Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->required(),

            Select::make('contact_type')
                ->label('Contact Type')
                ->options([
                    'email' => 'Email',
                    'phone' => 'Phone',
                    'whatsapp' => 'WhatsApp',
                    'github' => 'GitHub',
                    'linkedin' => 'LinkedIn',
                    'instagram' => 'Instagram',
                    'tiktok' => 'TikTok',
                ])
                ->required(),

            TextInput::make('contact_value')
                ->label('Contact Value')
                ->required()
                ->maxLength(255),

            Toggle::make('is_public')
                ->label('Public Contact')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([

                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('contact_type')
                    ->badge()
                    ->sortable(),

                TextColumn::make('contact_value')
                    ->searchable(),

                IconColumn::make('is_public')
                    ->boolean()
                    ->label('Public'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}