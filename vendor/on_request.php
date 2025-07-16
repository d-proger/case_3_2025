<?php

session_start();
require_once 'connect.php';



// Данные для нового поста


// Проверяем загрузку файла
if (!isset($_GET['post_id'])) {
    $_SESSION['message'] = 'Ошибка при загрузке файла';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
    exit();
}

$post_id = $_GET['post_id'];
$user_id = $_COOKIE['user_id']; // ID пользователя, который создает пост

// Подготовка SQL-запроса
$sql = "INSERT INTO on_requests (user_id, post_id, request_status) VALUES (:user_id, :post_id, :request_status)";
$stmt = $pdo->prepare($sql);

// Привязка параметров и выполнение запроса
try {
    $stmt->execute([
        ':user_id' => $user_id,
        ':post_id' => $post_id,
        ':request_status' => 0
    ]);

    // Проверка успешности вставки
    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = 'Запрос отправлен!';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
    } else {
        $_SESSION['message'] = 'Ошибка: запрос не был отправлен.';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
    }
} catch (PDOException $e) {
    $_SESSION['message'] = "Ошибка при отправке запроса: " . $e->getMessage();
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
}