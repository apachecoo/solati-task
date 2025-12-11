<?php

namespace App\Modules\Task\Application\UseCases;

use App\Modules\Task\Domain\Repositories\TaskRepositoryInterface;

class DeleteTaskUseCase
{

    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute($id): bool
    {
        return $this->repository->delete($id);
    }
}
