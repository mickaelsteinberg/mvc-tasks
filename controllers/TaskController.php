<?php

require_once __DIR__ . '/../models/repositories/TaskRepository.php';

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
        $task = $this->taskRepository->getTask($id);

        require_once __DIR__ . '/../views/view-task.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../views/create.php';
    }

    public function store()
    {
        var_dump($_POST);die;
    }

    public function forbidden()
    {
        require_once __DIR__ . '/../views/404.php';
        http_response_code(404);
    }
}