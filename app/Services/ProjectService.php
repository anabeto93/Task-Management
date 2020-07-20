<?php


namespace App\Services;

use App\DTOs\ServiceResponse;
use App\Repositories\Project\ProjectContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    /** @var ProjectContract */
    private $project;

    public function __construct(ProjectContract $projectContract)
    {
        $this->project = $projectContract;
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
}
