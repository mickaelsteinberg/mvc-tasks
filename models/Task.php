<?php

class Task
{
    public readonly int $id;
    public string $title;
    public string $description;
    public string $status;
    public readonly DateTime $createdAt;
    public readonly DateTime $updatedAt;
}
