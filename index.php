<?php

require_once __DIR__ . '/models/Task.php';

$taskRepo = new TaskRepository();

$task = new Task();
$task->title = 'Titre';
$task->description = 'Description';
$task->status = 'En cours';
// $taskRepo->create($task);