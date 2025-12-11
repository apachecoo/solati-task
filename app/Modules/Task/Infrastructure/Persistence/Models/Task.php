<?php

namespace App\Modules\Task\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Task\Domain\Enums\TaskStatus;

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
        'status'=> TaskStatus::class
    ];

}
