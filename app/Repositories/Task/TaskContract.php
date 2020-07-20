<?php

namespace App\Repositories\Task;

use App\Models\Project;
use App\Models\Task;

interface TaskContract
{
    public function create(array $data, Project $project): ?Task;

    public function find($id): ?Task;

    public function update($id, $data): ?Task;
}
