<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SkillResource\Pages;
use App\Models\Skill;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SkillResource extends Resource
{
    protected static ?string $model = Skill::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'portofolio management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->required()
                ->searchable(),

            Forms\Components\TextInput::make('skill_name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('proficiency_level')
                ->label('Proficiency Level')
                ->placeholder('Beginner / Intermediate / Expert')
                ->maxLength(255),

            Forms\Components\TextInput::make('category')
                ->placeholder('Frontend / Backend / DevOps')
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('skill_name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('proficiency_level')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'Beginner' => 'gray',
                        'Intermediate' => 'warning',
                        'Expert' => 'success',
                        default => 'secondary',
                    }),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('proficiency_level')
                    ->options([
                        'Beginner' => 'Beginner',
                        'Intermediate' => 'Intermediate',
                        'Expert' => 'Expert',
                    ]),

                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Frontend' => 'Frontend',
                        'Backend' => 'Backend',
                        'DevOps' => 'DevOps',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSkills::route('/'),
            'create' => Pages\CreateSkill::route('/create'),
            'edit' => Pages\EditSkill::route('/{record}/edit'),
        ];
    }
}