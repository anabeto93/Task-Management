<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectService;

class DeleteTaskController extends Controller
{
    
    /** @var ProjectService */
    private $project;

    public function __construct(ProjectService $projectService)
    {
        $this->project = $projectService;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {
        $this->project->delete($id);

        return response()->json([
            "status" => "Success",
            "message" => "Task deleted.",
            "error_code" => 200
        ]);
    }
}
