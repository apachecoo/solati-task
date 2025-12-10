<?php

namespace App\Modules\Task\Infrastructure\Mappers;

use App\Modules\Task\Application\DTOS\TaskDTO;
use App\Modules\Task\Domain\Entities\TaskEntity;
use App\Modules\Task\Infrastructure\Persistence\Models\Task as TaskModel;

class TaskMapper
{
    public static function fromModel(TaskModel $model): TaskDTO
    {
        return new TaskDTO(
            id: $model->id,
            title: $model->title,
            description: $model->description,
            status: $model->status,
            created_at: $model->created_at?->toImmutable(),
            updated_at: $model->updated_at?->toImmutable(),
        );
    }

    public static function toModel(TaskDTO $dto, ?TaskModel $model = null): TaskModel
    {
        $model ??= new TaskModel();
        $model->title = $dto->title;
        $model->description = $dto->description;
        $model->status = $dto->status;
        return $model;
    }

    public static function toEntity(TaskDTO $dto): TaskEntity
    {
        return new TaskEntity(
            id: $dto->id,
            title: $dto->title,
            description: $dto->description,
            status: $dto->status,
            created_at: $dto->created_at,
            updated_at: $dto->updated_at,
        );
    }

    public static function toDTO(TaskEntity $entity): TaskDTO
    {
        return new TaskDTO(
            id: $entity->id,
            title: $entity->title,
            description: $entity->description,
            status: $entity->status,
            created_at: $entity->created_at,
            updated_at: $entity->updated_at,
        );
    }

    public static function entityFromModel(TaskModel $model): TaskEntity
    {
        return self::toEntity(self::fromModel($model));
    }
}
