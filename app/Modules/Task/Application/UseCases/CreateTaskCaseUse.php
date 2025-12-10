<?php

namespace App\Modules\Task\Application\UseCases;

use App\Modules\Task\Application\DTOS\TaskDTO;
use App\Modules\Task\Domain\Entities\TaskEntity;
use App\Modules\Task\Domain\Repositories\TaskRepositoryInterface;

class CreateTaskCaseUse
{

    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function execute(TaskDTO $dto): TaskEntity
    {
        return $this->repository->create($dto);
    }
}
