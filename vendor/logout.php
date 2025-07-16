<?php
session_start();
unset($_SESSION['user']);
// Удаление куки
setcookie('user_id', '', [
    'expires' => time() - 3600, // Время истечения в прошлом
    'path' => '/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
header('Location: ../index.php');