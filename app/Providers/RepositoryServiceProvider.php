<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Task\Domain\Repositories\TaskRepositoryInterface;
use App\Modules\Task\Infrastructure\Persistence\Repositories\EloquentTaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        /** Module Task */
        $this->app->bind(
            TaskRepositoryInterface::class,
            EloquentTaskRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
