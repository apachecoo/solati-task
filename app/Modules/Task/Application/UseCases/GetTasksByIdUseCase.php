<?php

namespace App\Modules\Task\Application\UseCases;

use App\Modules\Task\Domain\Repositories\TaskRepositoryInterface;
use App\Modules\Task\Domain\Entities\TaskEntity;

class GetTasksByIdUseCase
{

    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(int $id): ?TaskEntity
    {
        return $this->repository->getById($id);
    }
}
