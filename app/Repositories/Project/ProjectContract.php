<?php


namespace App\Repositories\Project;

use App\Models\Project;

interface ProjectContract
{
    public function create(array $properties): ?Project;
}
