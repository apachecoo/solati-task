<?php

namespace App\Modules\Task\Infrastructure\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\Task\Application\DTOS\TaskDTO;
use App\Modules\Task\Application\UseCases\CreateTaskCaseUse;
use App\Modules\Task\Application\UseCases\GetTasksUseCase;
use App\Modules\Task\Application\UseCases\GetTasksByIdUseCase;
use App\Modules\Task\Application\UseCases\UpdateTaskCaseUse;
use App\Modules\Task\Application\UseCases\DeleteTaskUseCase;
use App\Modules\Task\Domain\Enums\TaskStatus;
use App\Modules\Task\Infrastructure\Http\Requests\TaskRequest;

class TasksController extends Controller
{
    public function __construct(
        private CreateTaskCaseUse $createTaskCaseUse,
        private GetTasksUseCase $getTasksCaseUse,
        private GetTasksByIdUseCase $getTasksByIdUseCase,
        private UpdateTaskCaseUse $updateTaskCaseUse,
        private DeleteTaskUseCase $deleteTaskUseCase
    ) {}


    public function index()
    {
        $data = $this->getTasksCaseUse->execute();
        return response()->json($data, 200);
    }

    public function store(TaskRequest $taskRequest)
    {

        $dto = new TaskDTO(
            title: $taskRequest->input('title'),
            description: $taskRequest->input('description')
        );
        $task = $this->createTaskCaseUse->execute($dto);

        return response()->json($task, 201);
    }

    public function show(int $id)
    {
        $task = $this->getTasksByIdUseCase->execute($id);

        return response()->json($task ?? null, 200);
    }

    public function update(TaskRequest $taskRequest, int $id)
    {
        $status = $taskRequest->input('status') ? TaskStatus::from($taskRequest->input('status')) : null;
        $dto = new TaskDTO(
            title: $taskRequest->input('title'),
            description: $taskRequest->input('description'),
            id: $id,
            status: $status,
        );
        $task = $this->updateTaskCaseUse->execute($dto);

        return response()->json($task ?? null, 200);
    }

    public function destroy(int $id)
    {
        $taskDeleted = $this->deleteTaskUseCase->execute($id);
        if (!$taskDeleted) {
            return response()->json([
                'deleted' => false,
                'message' => 'Task not found'
            ], 404);
        }

        return response()->noContent();
    }
}
