<?php

namespace App\Repositories\Task;

use App\Models\Project;
use App\Models\Task;

class TaskRepository implements TaskContract
{
    public function create(array $data, Project $project): ?Task
    {
        //priority is first come, first serve
        $data['priority'] = $project->tasks()->count() + 1;

        $task = Task::create($data);

        return $task;
    }

    public function find($id): ?Task
    {
        return Task::find($id);
    }

    public function update($id, $data): ?Task
    {
        $task = Task::find($id);

        if (!$task) return null;

        $task->update($data);

        return $task->fresh();
    }
}
