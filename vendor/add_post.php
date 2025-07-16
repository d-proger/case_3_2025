<?php
session_start();
require_once('./connect.php');

if (!isset($_COOKIE['user_id'])) {
    header('Location: /');
    exit();
}

$title = $_POST['title'];
$content = $_POST['content'];
$on_request = $_POST['on_request'];
$user_id = $_COOKIE['user_id'];
$tags = isset($_POST['tags']) ? explode(',', $_POST['tags']) : [];

// Загрузка изображения
$post_img = 'default.jpg'; // Значение по умолчанию
if ($_FILES['post_img']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../uploads/';
    $post_img = uniqid() . '_' . basename($_FILES['post_img']['name']);
    move_uploaded_file($_FILES['post_img']['tmp_name'], $upload_dir . $post_img);
}

// Вставляем пост
$stmt = $pdo->prepare("INSERT INTO posts (title, content, on_request, post_img, user_id) VALUES (:title, :content, :on_request, :post_img, :user_id)");
$stmt->execute([
    ':title' => $title,
    ':content' => $content,
    ':on_request' => $on_request,
    ':post_img' => '/uploads/' . $post_img,
    ':user_id' => $user_id
]);
$post_id = $pdo->lastInsertId();

// Добавляем теги
foreach ($tags as $tagName) {
    $tagName = trim($tagName);
    if (!empty($tagName)) {
        // Проверяем, существует ли тег
        $stmt = $pdo->prepare("SELECT id FROM tags WHERE name = :name");
        $stmt->execute([':name' => $tagName]);
        $tag = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$tag) {
            // Если тег не существует, создаем его
            $stmt = $pdo->prepare("INSERT INTO tags (name) VALUES (:name)");
            $stmt->execute([':name' => $tagName]);
            $tag_id = $pdo->lastInsertId();
        } else {
            $tag_id = $tag['id'];
        }

        // Связываем тег с постом
        $stmt = $pdo->prepare("INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)");
        $stmt->execute([
            ':post_id' => $post_id,
            ':tag_id' => $tag_id
        ]);
    }
}

$_SESSION['message'] = 'Пост успешно добавлен!';
header('Location: /add_post.php');
exit();
?>