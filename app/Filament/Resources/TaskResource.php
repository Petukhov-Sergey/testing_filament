<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Project;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-s-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('description')->nullable(),
                Select::make('status')
                    ->required()
                    ->options([
                        'В архиве' => 'В архиве',
                        'К старту' => 'К старту',
                        'В процессе' => 'В процессе',
                        'Завершенные' => 'Завершенные',
                    ]),
                Select::make('project_id')
                    ->relationship('project', 'name')
                    ->required()
                    ->label('Project'),
                Select::make('performer_ids')
                    ->multiple()
                    ->relationship('performers', 'name')
                    ->preload()
                    ->label('Performers'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->sortable(),
                TextColumn::make('project.name')->label('Project')->sortable(),
                TextColumn::make('performers.name')
                    ->label('Performers')
                    ->formatStateUsing(function ($state) {
                        if ($state instanceof Collection) {
                            return $state->pluck('name')->implode(', ');
                        }
                        return $state;
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
