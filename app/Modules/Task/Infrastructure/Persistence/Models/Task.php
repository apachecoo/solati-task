<?php

namespace App\Modules\Task\Infrastructure\Persistence\Models;

use App\Modules\Task\Domain\Enums\TaskStatus as EnumsTaskStatus;
use Illuminate\Database\Eloquent\Model;
use App\Task\App\Modules\Task\Domain\Enums\TaskStatus;

class Task extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'status'=> EnumsTaskStatus::class
    ];

}
