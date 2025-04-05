<?php

require_once __DIR__ . '/../models/repositories/UserRepository.php';

class AuthController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        require __DIR__ . '/../views/login.php';
    }

    public function doLogin()
    {
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $user = $this->userRepository->getUserByUsername($username);

        if (password_verify($password, $user->getPassword())) {
            $_SESSION['user_id'] = $user->getId();
            $_SESSION['role'] = $user->getRole();

            header('Location: ?');
            exit;
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id'], $_SESSION['role']);
        header('Location: ?');
        exit;
    }
}