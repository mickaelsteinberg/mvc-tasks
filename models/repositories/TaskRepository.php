<?php

require_once __DIR__ . '/../Task.php';
require_once __DIR__ . '/../../lib/database.php';

class TaskRepository
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function getTasks(): array
    {
        $statement = $this->connection->getConnection()->query('SELECT * FROM tasks');
        $result = $statement->fetchAll();
        $tasks = [];
        foreach ($result as $row) {
            $task = new Task();
            $task->setId($row['id']);
            $task->setTitle($row['title']);
            $task->setDescription($row['description']);
            $task->setStatus($row['status']);
            $task->setCreatedAt(date_create_from_format('Y-m-d H:i:s', $row['created_at']));
            $task->setUpdatedAt(date_create_from_format('Y-m-d H:i:s', $row['updated_at']));

            $tasks[] = $task;
        }

        return $tasks;
    }

    public function getTask(int $id): ?Task
    {
        $statement = $this->connection->getConnection()->prepare("SELECT * FROM tasks WHERE id=:id");
        $statement->execute(['id' => $id]);
        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $task = new Task();
        $task->setId($result['id']);
        $task->setTitle($result['title']);
        $task->setDescription($result['description']);
        $task->setStatus($result['status']);
        $task->setCreatedAt(date_create_from_format('Y-m-d H:i:s', $result['created_at']));
        $task->setUpdatedAt(date_create_from_format('Y-m-d H:i:s', $result['updated_at']));

        return $task;
    }

    public function create(Task $task): bool
    {
        $statement = $this->connection
                ->getConnection()
                ->prepare('INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status);');

        return $statement->execute([
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'status' => $task->getStatus()
        ]);
    }

    public function update(Task $task): bool
    {
        $statement = $this->connection
                ->getConnection()
                ->prepare('UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id');

        return $statement->execute([
            'id' => $task->getId(),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'status' => $task->getStatus()
        ]);
    }

    public function delete(int $id): bool
    {
        $statement = $this->connection
                ->getConnection()
                ->prepare('DELETE FROM tasks WHERE id = :id');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }

}