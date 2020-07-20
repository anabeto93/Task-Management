<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectFormRequest;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class CreateProjectController extends Controller
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
    public function __invoke(CreateProjectFormRequest $request)
    {
        $response = $this->project->create($request);

        return response()->json($response->toArray(), $response->toArray()['error_code']);
    }
}
