<?php


namespace App\Services;

use App\DTOs\ServiceResponse;
use App\Repositories\Project\ProjectContract;
use App\Repositories\Task\TaskContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    /** @var ProjectContract */
    private $project;

    /** @var TaskContract */
    private $task;

    public function __construct(ProjectContract $projectContract, TaskContract $taskContract)
    {
        $this->project = $projectContract;
        $this->task = $taskContract;
    }

    public function create(Request $request): ServiceResponse
    {
        DB::beginTransaction();

        try {
            $project = $this->project->create($request->all());
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error("::PROJECT_SERVICE:: Error Creating Project.", [
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ]);

            return new ServiceResponse("Error", "Failed creating project.", 500);
        }

        DB::commit();

        return new ServiceResponse("Success", "Project created successfully.", 201, [
            "project" => $project,
        ]);
    }

    public function getTasks($id)
    {
        $project = $this->project->find($id);

        return $project->tasks;
    }

    public function addTask(Request $request): ServiceResponse
    {
        $id = $request->input('project_id');

        DB::beginTransaction();

        try {
            $project = $this->project->find($id);

            if (!$project) {
                return new ServiceResponse("Declined", "Project not found.", 404);
            }

            $data = [
                'name' => $request->input('name'),
                'project_id' => $id,
            ];

            $task = $this->task->create($data, $project);

        } catch(\Exception $e) {
            DB::rollBack();

            Log::error("::PROJECT_SERVICE:: Error Adding Task To Project.", [
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ]);

            return new ServiceResponse("Error", "Failed to add task", 500);

        }

        DB::commit();

        return new ServiceResponse("Success", "Task successfully added.", 201, [
            'task' => $task,
        ]);
    }

    public function delete($id): void
    {
        $task = $this->task->find($id);
        $priority = $task->priority;
        $task->delete();
        
        if (!$task) {
            return;
        }

        $project = $task->project;

        $count = 0;
        foreach($project->tasks()->where('priority', '>', $priority)->get() as $key => $task) {
            $task->priority = $priority + $count++;
            $task->save();
        }
    }

    public function updateTask(Request $request): ServiceResponse
    {
        DB::beginTransaction();

        $id = $request->input('project_id');

        try {
            $project = $this->project->find($id);

            if (!$project) {
                return new ServiceResponse("Declined", "Project not found.", 404);
            }

            $task = $this->task->update($project->id, $request->all());
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error("::PROJECT_SERVICE:: Error Updating Project.", [
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ]);

            return new ServiceResponse("Error", "Failed Updating project.", 500);
        }

        DB::commit();

        return new ServiceResponse("Success", "Task Updated successfully.", 201, [
            "task" => $task,
        ]);

    }

    public function sortTasks(Request $request): ServiceResponse
    {
        DB::beginTransaction();

        try {
            $task_id = $request->input('id');

            $task = $this->task->find($task_id);

            if (!$task) {
                return new ServiceResponse("Declined", "Task not found.", 404);
            }

            $project = $task->project;

            $this->task->update($task_id, ['priority' => 1]);

            $count = 2;

            foreach($project->tasks as $task) {
                if ($task->id != $task_id) {
                    $task->priority = $count++;
                    $task->save();
                }
            }
        } catch(\Exception $e) {
            DB::rollBack();
            Log::error("::PROJECT_SERVICE:: Error Sorts Project tasks.", [
                "code" => $e->getCode(),
                "message" => $e->getMessage(),
            ]);

            return new ServiceResponse("Error", "Failed Sorts project tasks.", 500);
        }

        DB::commit();

        return new ServiceResponse("Success", "Project tasks sorted.", 200, [
            'task' => $task,
        ]);
    }
}
