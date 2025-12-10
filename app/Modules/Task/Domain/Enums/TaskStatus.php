<?php

namespace App\Modules\Task\Domain\Enums;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
}