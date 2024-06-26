<div class="kanban-board">
    <div class="kanban-columns">
        @foreach ($performers as $performer)
            <div class="kanban-column">
                <div class="kanban-column-header">{{ $performer->name }}</div>
                <div class="kanban-column-body">
                    @foreach ($performer->tasks as $task)
                        <div class="kanban-card">
                            <div class="kanban-card-title">{{ $task->title }}</div>
                            <div class="kanban-card-description">{{ $task->description }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .kanban-board {
        display: flex;
        overflow-x: auto;
        padding: 10px;
    }
    .kanban-columns {
        display: flex;
        gap: 10px;
    }
    .kanban-column {
        background: #f5f5f5;
        border-radius: 5px;
        width: 300px;
        flex-shrink: 0;
    }
    .kanban-column-header {
        background: #ccc;
        padding: 10px;
        font-weight: bold;
    }
    .kanban-column-body {
        padding: 10px;
    }
    .kanban-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 3px;
        padding: 10px;
        margin-bottom: 10px;
    }
</style>
