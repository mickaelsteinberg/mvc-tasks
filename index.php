<?php

require_once __DIR__ . '/lib/database.php';
require_once __DIR__ . '/models/Task.php';


$db = new DatabaseConnection();

$tasks = $db->getConnection()->query('SELECT * FROM tasks')->fetchAll();

var_dump($tasks);

