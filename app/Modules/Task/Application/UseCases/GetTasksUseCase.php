<?php

namespace App\Modules\Task\Application\UseCases;

use App\Modules\Task\Domain\Repositories\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetTasksUseCase
{

    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(): ?Collection
    {
        return $this->repository->getAll([]);
    }
}
