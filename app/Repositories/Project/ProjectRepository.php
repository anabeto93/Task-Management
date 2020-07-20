<?php


namespace App\Repositories\Project;


use App\Models\Project;

class ProjectRepository implements ProjectContract
{
    public function create(array $properties): ?Project
    {
        $project = Project::create($properties);

        return $project;
    }

    public function all()
    {
        return Project::all();
    }

    public function find($id): ?Project
    {
        $project = Project::find($id);

        return $project;
    }
}
