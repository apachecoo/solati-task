<?php

namespace App\Modules\Task\Application\UseCases;

use App\Modules\Task\Domain\Repositories\TaskRepositoryInterface;
use App\Modules\Task\Application\DTOS\TaskDTO;

class UpdateTaskCaseUse 
{
    public function __construct(
        private TaskRepositoryInterface $repository
    )
    {}

    public function execute(TaskDTO $dto){
        return $this->repository->update($dto);
    }
}