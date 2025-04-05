<?php

function isConnected()
{
    if (isset($_SESSION['user_id'], $_SESSION['role'])) {
        return true;
    }
    return false;
}

function isAdmin() 
{
    if (!(isConnected() && $_SESSION['role'] === 'admin')) {
        $_SESSION['flash_message'] = 'Vous n’avez pas les droits';
        header('Location: ?');
        exit;
    } 
    return true;
}