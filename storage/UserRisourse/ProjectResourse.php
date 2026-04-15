<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Portfolio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('user_id')
                    ->relationship('user','name')
                    ->required(),

                Forms\Components\TextInput::make('project_title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('project_type'),

                Forms\Components\TextInput::make('client_name'),

                Forms\Components\TextInput::make('role'),

                Forms\Components\DatePicker::make('start_date'),

                Forms\Components\DatePicker::make('end_date'),

                Forms\Components\Toggle::make('is_ongoing')
                    ->label('Project Ongoing'),

                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('technologies')
                    ->placeholder('Laravel, React, MySQL'),

                Forms\Components\TextInput::make('project_url')
                    ->url(),

                Forms\Components\TextInput::make('github_url')
                    ->url(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->directory('projects')
                    ->image()
                    ->imagePreviewHeight('150')
                    ->disk('public'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->square(),

                Tables\Columns\TextColumn::make('project_title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('project_type')
                    ->badge(),

                Tables\Columns\TextColumn::make('client_name'),

                Tables\Columns\TextColumn::make('role'),

                Tables\Columns\IconColumn::make('is_ongoing')
                    ->boolean(),

                Tables\Columns\TextColumn::make('start_date')
                    ->date(),

                Tables\Columns\TextColumn::make('end_date')
                    ->date(),

            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_ongoing')
                    ->label('Project Status'),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}