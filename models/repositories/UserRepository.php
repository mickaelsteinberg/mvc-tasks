<?php

require_once __DIR__ . '/../../lib/database.php';
require_once __DIR__ . '/../User.php';

class UserRepository 
{
    public DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function getUserByUsername(string $username): ?User
    {
        $statement = $this->connection->getConnection()->prepare('SELECT * FROM users WHERE username = :username');
        $statement->execute(['username' => $username]);

        $result = $statement->fetch();

        if (!$result) {
            return null;
        }

        $user = new User();
        $user->setId($result['id']);
        $user->setUsername($result['username']);
        $user->setPassword($result['password']);
        $user->setRole($result['role']);
        return $user;
    }
}