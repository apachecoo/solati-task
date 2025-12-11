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
        $search = $filter['search'] ?? null;

        if ($search) {
            $query->where('title', 'like', '%' . $filter['query'] . '%')
                ->orWhere('description', 'like', '%' . $filter['query'] . '%');
        }

        return $query->get();
    }

    public function getById(int $id): ?TaskEntity
    {
        $model = TaskModel::find($id);
        if ($model) {
            return TaskMapper::entityFromModel($model);
        }
        return null;
    }

    public function create(TaskDTO $dto): TaskEntity
    {
        $model = new TaskModel();
        $model->title = $dto->title;
        $model->description = $dto->description;
        $model->status = TaskStatus::PENDING->value;
        $model->save();
        return TaskMapper::entityFromModel($model);
    }

    public function update(TaskDTO $dto): TaskEntity
    {
        $model = TaskModel::findOrFail($dto->id);

        $fields = [
            'title'       => $dto->title,
            'description' => $dto->description,
            'status'      => $dto->status?->value,
        ];

        $data = array_filter(
            $fields,
            fn($value) => !empty($value)
        );

        if ($data) {
            $model->fill($data)->save();
        }

        return TaskMapper::entityFromModel($model);
    }

    public function delete(int $id): bool
    {
        $model = TaskModel::find($id);
        if (!$model) {
            return false;
        }

        return (bool) $model->delete();
    }
}
