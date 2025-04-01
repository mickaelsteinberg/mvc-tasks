<?php

require_once __DIR__ . '/../lib/database.php';

class Task
{
    private int $id;
    private string $title;
    private string $description;
    private string $status;
    private DateTime $createdAt;
    private DateTime $updatedAt;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTitle(string $title): void
    {
        $this->title = htmlspecialchars($title);
    }

    public function setDescription(string $description): void
    {
        $this->description = htmlspecialchars($description);
    }

    public function setStatus(string $status): void
    {
        $this->status = htmlspecialchars($status);
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
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