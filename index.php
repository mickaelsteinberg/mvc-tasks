<?php

require_once __DIR__ . '/models/repositories/TaskRepository.php';

$taskRepo = new TaskRepository();

if (isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
    
    $task = $taskRepo->getTask($_GET['id']);
    require_once __DIR__ . '/views/view-task.php';

} else {
    
    $tasks = $taskRepo->getTasks();
    require_once __DIR__ . '/views/home.php';    
    
}

