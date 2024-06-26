<?php
namespace App\Enums;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum TaskStatus: string
{
    use IsKanbanStatus;
    case Archived = 'В архиве';
    case On_start = 'К старту';
    case In_progress = 'В процессе';
    case Finished = 'Завершенные';
}
