<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskFormRequest;
use Illuminate\Http\Request;
use App\Services\ProjectService;

class UpdateTaskController extends Controller
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
    public function __invoke(UpdateTaskFormRequest $request, string $id)
    {
        $request->merge([
            'id' => $id,
        ]);
        
        $result = $this->project->updateTask($request);

        return response()->json($result->toArray(), $result->toArray()['error_code']);
    }
}
