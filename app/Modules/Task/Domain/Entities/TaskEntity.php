<?php

namespace App\Modules\Task\Domain\Entities;

use App\Modules\Task\Domain\Enums\TaskStatus;

class TaskEntity
{

    public function __construct(
        public readonly ?int $id,
        public readonly string $title, 
        public readonly string $description,
        public readonly ?TaskStatus $status = null,
        public readonly ?\DateTimeImmutable $created_at,
        public readonly ?\DateTimeImmutable $updated_at,
    )
    {}
}