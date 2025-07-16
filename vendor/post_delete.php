<?php
session_start();
require_once('./connect.php');

// Проверяем, авторизован ли пользователь
if (!isset($_COOKIE['user_id'])) {
    $_SESSION['message'] = 'Для выполнения этого действия необходимо авторизоваться.';
    header('Location: /login.php'); // Перенаправляем на страницу входа
    exit();
}

// Проверяем, передан ли ID поста
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = 'Неверный ID поста.';
    header('Location: /'); // Перенаправляем на главную страницу
    exit();
}

$post_id = (int) $_GET['id']; // Получаем ID поста
$user_id = $_COOKIE['user_id']; // Получаем ID текущего пользователя

// Проверяем, существует ли пост и принадлежит ли он текущему пользователю
$stmt = $pdo->prepare("SELECT user_id FROM posts WHERE id = :post_id");
$stmt->execute([':post_id' => $post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    $_SESSION['message'] = 'Пост не найден.';
    header('Location: /'); // Перенаправляем на главную страницу
    exit();
}

// Проверяем, является ли пользователь автором поста или администратором
if ($post['user_id'] != $user_id) {
    $_SESSION['message'] = 'Вы не можете удалить этот пост.';
    header('Location: /'); // Перенаправляем на главную страницу
    exit();
}

// Удаляем пост
try {
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :post_id");
    $stmt->execute([':post_id' => $post_id]);

    // Удаляем связанные теги (если используется таблица post_tags)
    $stmt = $pdo->prepare("DELETE FROM post_tags WHERE post_id = :post_id");
    $stmt->execute([':post_id' => $post_id]);

    $_SESSION['message'] = 'Пост успешно удален.';
} catch (PDOException $e) {
    $_SESSION['message'] = 'Ошибка при удалении поста: ' . $e->getMessage();
}

header('Location: /'); // Перенаправляем на главную страницу
exit();
?>