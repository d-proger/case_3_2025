<?php
session_start();
require_once('./connect.php');

if (!isset($_COOKIE['user_id'])) {
    header('Location: /');
    exit();
}

$post_id = $_POST['post_id'];
$content = $_POST['content'];
$user_id = $_COOKIE['user_id'];


// Вставляем коммент
$stmt = $pdo->prepare("INSERT INTO comments (post_id, content, user_id) VALUES (:post_id, :content, :user_id)");
$stmt->execute([
    ':post_id' => $post_id,
    ':content' => $content,
    ':user_id' => $user_id
]);



$_SESSION['message'] = 'Ваш комментарий успешно добавлен!';
header("Location: /post.php?id=$post_id");
exit();
