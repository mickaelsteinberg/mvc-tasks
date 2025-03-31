<?php

require_once __DIR__ . '/../lib/database.php';

class Task
{
    public int $id;
    public string $title;
    public string $description;
    public string $status;
    public DateTime $createdAt;
    public DateTime $updatedAt;
}

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
            $task->id = $row['id'];
            $task->title = $row['title'];
            $task->description = $row['description'];
            $task->status = $row['status'];
            $task->createdAt = date_create_from_format('Y-m-d H:i:s', $row['created_at']);
            $task->updatedAt = date_create_from_format('Y-m-d H:i:s', $row['updated_at']);

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
        $task->id = $result['id'];
        $task->title = $result['title'];
        $task->description = $result['description'];
        $task->status = $result['status'];
        $task->createdAt = date_create_from_format('Y-m-d H:i:s', $result['created_at']);
        $task->updatedAt = date_create_from_format('Y-m-d H:i:s', $result['updated_at']);

        return $task;
    }

    public function create(Task $task): bool
    {
        $statement = $this->connection
                ->getConnection()
                ->prepare('INSERT INTO tasks (title, description, status) VALUES (:title, :description, :status);');
        $statement->bindParam(':title', $task->title);
        $statement->bindParam(':description', $task->description);
        $statement->bindParam(':status', $task->status);

        return $statement->execute();
    }

    public function update(Task $task): bool
    {
        $statement = $this->connection
                ->getConnection()
                ->prepare('UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id');
        $statement->bindParam(':id', $task->id);
        $statement->bindParam(':title', $task->title);
        $statement->bindParam(':description', $task->description);
        $statement->bindParam(':status', $task->status);

        return $statement->execute();
    }

    public function delete(int $id)
    {
        $statement = $this->connection
                ->getConnection()
                ->prepare('DELETE FROM tasks WHERE id = :id');
        $statement->bindParam(':id', $id);

        return $statement->execute();
    }

}