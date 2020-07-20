<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskFormRequest;
use Illuminate\Http\Request;
use App\Services\ProjectService;

class CreateTaskController extends Controller
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
    public function __invoke(CreateTaskFormRequest $request)
    {
        $result = $this->project->addTask($request);

        return response()->json($result->toArray(), $result->toArray()['error_code']);
    }
}
