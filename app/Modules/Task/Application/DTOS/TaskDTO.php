<?php

namespace App\Modules\Task\Application\DTOS;

use App\Modules\Task\Domain\Enums\TaskStatus;

class TaskDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly ?int $id = null,
        public readonly ?TaskStatus $status = null,
        public readonly ?\DateTimeImmutable $created_at = null,
        public readonly ?\DateTimeImmutable $updated_at = null,
    ) {}
}
