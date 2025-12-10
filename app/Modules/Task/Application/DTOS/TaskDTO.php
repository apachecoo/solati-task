<?php

namespace App\Modules\Task\Application\DTOS;

class TaskDTO
{

    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $title = null,
        public readonly ?string $description = null,
        public readonly ?string $status = null,
        public readonly ?\DateTimeImmutable $created_at = null,
        public readonly ?\DateTimeImmutable $updated_at = null,
    ) {}
}
