<?php
session_start();

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['username' => 'Usejd', 'email' => 'usejd@test.com', 'password' => 'userusejd1', 'role' => 'user'],
        ['username' => 'Shpat', 'email' => 'shpat@test.com', 'password' => 'usershpat1', 'role' => 'user'],
        ['username' => 'admin', 'email' => 'admin@test.com', 'password' => 'admin123', 'role' => 'admin']
    ];
}

$users = $_SESSION['users'];
?>