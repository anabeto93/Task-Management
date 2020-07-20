<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProjectService;

class SortTasksController extends Controller
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
    public function __invoke(Request $request)
    {
        $result = $this->project->sortTasks($request);

        return response()->json($result->toArray(), $result->toArray()['error_code']);
    }
}
