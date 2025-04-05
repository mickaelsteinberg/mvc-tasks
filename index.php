<?php

session_start();

require_once __DIR__ . '/controllers/TaskController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/lib/utils.php';

$taskController = new TaskController();
$authController = new AuthController();

$action = $_GET['action'] ?? 'index'; // Si $_GET['action'] est null ou vide, alors on renvoi index. Sinon on renvoi $_GET['action']
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'logout':
        $authController->logout();
        break;
    case 'doLogin':
        $authController->doLogin();
        break;
    case 'login':
        $authController->login();
        break;
    case 'view':
        $taskController->show($id);
        break;
    case 'create':
        $taskController->create();
        break;
    case 'index':
        $taskController->home();
        break;
    case 'store':
        $taskController->store();
        break;
    case 'edit':
        $taskController->edit($id);
        break;
    case 'update':
        $taskController->update();
        break;
    case 'delete':
        $taskController->delete($id);
        break;
    default:
        $taskController->forbidden();
        break;
}
