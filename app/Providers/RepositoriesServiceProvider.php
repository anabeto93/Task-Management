<?php

namespace App\Providers;


use App\Repositories\Task\TaskContract;
use App\Repositories\Task\TaskRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Project\ProjectContract;
use App\Repositories\Project\ProjectRepository;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProjectContract::class, ProjectRepository::class);
        $this->app->bind(TaskContract::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
