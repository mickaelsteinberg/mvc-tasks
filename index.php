<?php

require_once __DIR__ . '/models/repositories/TaskRepository.php';

$taskRepo = new TaskRepository();

// $task = new Task();
// $task->setTitle('');
// $task->setDescription('Description');
// $task->setStatus('En cours');
// $taskRepo->create($task);

$task = $taskRepo->getTask(9);
echo $task->getTitle();