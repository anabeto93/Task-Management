<?php

namespace App\Http\Controllers;

use App\Repositories\Project\ProjectContract;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /** @var ProjectContract */
    private $project;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectContract $projectContract)
    {
        $this->middleware('auth');
        $this->project = $projectContract;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = $this->project->all();
        $url = explode("/projects/",route("tasks.view", ['id' => 1]))[0] . "/projects";

        return view('home')->withProjects($projects)->withUrl($url);
    }
}
