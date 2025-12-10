<?php

namespace App\Modules\Task\Infrastructure\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Task\Application\DTOS\TaskDTO;
use App\Modules\Task\Application\UseCases\CreateTaskCaseUse;
use App\Modules\Task\Application\UseCases\GetTasksUseCase;

class TasksController extends Controller
{
    public function __construct(
        private CreateTaskCaseUse $createTaskCaseUse,
        private GetTasksUseCase $getTasksCaseUse
    )
    {}

    public function store(Request $taskRequest){
        
        // dd($taskRequest);
        $dto = new TaskDTO(
            title: $taskRequest->input('title'),
            description: $taskRequest->input('description')
        );

        $task = $this->createTaskCaseUse->execute($dto);

        return response()->json($task, 201);
    }

}
