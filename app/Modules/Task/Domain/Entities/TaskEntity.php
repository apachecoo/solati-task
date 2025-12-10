<?php

namespace App\Modules\Task\Domain\Entities;

class TaskEntity
{

    public function __construct(
        public readonly ?int $id,
        public readonly ?string $title = null, 
        public readonly ?string $description = null,
        public readonly ?string $status = null,
        public readonly ?\DateTimeImmutable $created_at,
        public readonly ?\DateTimeImmutable $updated_at,
    )
    {}
}