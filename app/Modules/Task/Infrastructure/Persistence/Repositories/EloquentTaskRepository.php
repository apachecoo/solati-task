<?php

namespace App\Modules\Task\Infrastructure\Persistence\Repositories;

use App\Modules\Task\Application\DTOS\TaskDTO;
use App\Modules\Task\Domain\Entities\TaskEntity;
use App\Modules\Task\Domain\Repositories\TaskRepositoryInterface;
use App\Modules\Task\Domain\Enums\TaskStatus;
use App\Modules\Task\Infrastructure\Persistence\Models\Task as TaskModel;
use App\Modules\Task\Infrastructure\Mappers\TaskMapper;
use Illuminate\Database\Eloquent\Collection;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function getAll(array $filter): ?Collection
    {
        $query = TaskModel::query();
        $query = $filter['query'] ?? null;

        if ($query) {
            $query->where('title', 'like', '%' . $filter['query'] . '%')
                ->orWhere('description', 'like', '%' . $filter['query'] . '%');
        }

        return $query->get();
    }

    public function create(TaskDTO $dto): TaskEntity
    {
        //  dd(TaskStatus::PENDING->value);
        $model = new TaskModel();
        $model->title = $dto->title;
        $model->description = $dto->description;
        $model->status = TaskStatus::PENDING->value;
        $model->save();
        return TaskMapper::entityFromModel($model);
    }

    public function update(TaskDTO $dto): TaskEntity
    {
        $model = TaskModel::find($dto);
        $model->title = $dto->title;
        $model->description = $dto->description;
        $model->status = $dto->status;
        $model->save();

        return TaskMapper::entityFromModel($model);
    }
}
