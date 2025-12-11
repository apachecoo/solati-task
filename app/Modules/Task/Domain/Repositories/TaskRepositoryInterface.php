<?php

namespace App\Modules\Task\Domain\Repositories;

use App\Modules\Task\Application\DTOS\TaskDTO;
use App\Modules\Task\Domain\Entities\TaskEntity;
use Illuminate\Database\Eloquent\Collection;

interface TaskRepositoryInterface
{
    public function getAll(array $filter): ?Collection;
    public function getById(int $id): ?TaskEntity;
    public function create(TaskDTO $dto): TaskEntity;
    public function update(TaskDTO $dto): TaskEntity;
    public function delete(int $id): bool;
}
