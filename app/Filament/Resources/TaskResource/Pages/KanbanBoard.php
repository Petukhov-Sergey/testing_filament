<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Actions;
use Filament\Pages\Page;
use Filament\Resources\Pages\ViewRecord;

class KanbanBoard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-view-boards';
    protected static string $view = 'filament.pages.kanban-board';

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, [
            'performers' => \App\Models\User::has('tasks')->with('tasks')->get(),
        ]);
    }
}
