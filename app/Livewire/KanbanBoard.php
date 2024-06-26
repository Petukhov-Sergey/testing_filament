<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Livewire\Component;

class KanbanBoard extends Component
{
    public $performers;
    public $tasks;

    public function mount()
    {
        $this->performers = User::has('tasks')->with('tasks')->get();
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.kanban-board', [
            'performers' => $this->performers,
            'tasks' => $this->tasks,
        ]);
    }
}
