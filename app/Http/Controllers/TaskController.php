<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\ProjectService;

class TaskController extends Controller
{
    /** @var ProjectService */
    private $project;
    
    public function __construct(ProjectService $project)
    {
        $this->project = $project;
    }
    public function show(Request $request, string $id)
    {
        $tasks = $this->project->getTasks($id);

        return view('tasks')->withTasks($tasks);
    }
}
