<?php

require_once __DIR__ . '/../models/repositories/TaskRepository.php';
require_once __DIR__ . '/../models/Task.php';

class TaskController
{
    private TaskRepository $taskRepository;

    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    public function home()
    {
        $tasks = $this->taskRepository->getTasks();

        require_once __DIR__ . '/../views/home.php';
    }

    public function show(int $id) 
    {
        if (isConnected()) {
            $task = $this->taskRepository->getTask($id);

            require_once __DIR__ . '/../views/view-task.php';
        }
    }

    public function create()
    {
        if (isAdmin()) {
            require_once __DIR__ . '/../views/create.php';
        }
    }

    public function store()
    {
        $task = new Task();
        $task->setTitle($_POST['title']);
        $task->setDescription($_POST['description']);
        $task->setStatus($_POST['status']);
        $this->taskRepository->create($task);

        header('Location: ?');
        exit;
    }

    public function edit(int $id)
    {
        if (isAdmin()) {
            $task = $this->taskRepository->getTask($id);
            require_once __DIR__ . '/../views/edit.php';
        }
    }

    public function update()
    {
        if (isAdmin()) {
            $task = new Task();
            $task->setId($_POST['id']);
            $task->setTitle($_POST['title']);
            $task->setDescription($_POST['description']);
            $task->setStatus($_POST['status']);
            $this->taskRepository->update($task);

            header('Location: ?');
            exit;
        }
    }

    public function delete(int $id)
    {
        $this->taskRepository->delete($id);

        header('Location: ?');
        exit;
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
}