<?php

session_start();
require_once 'connect.php';



$email = $_POST['email'];
$password = $_POST['password']; // Не хешируем здесь, потому что будем проверять с хешированным значением из БД

try {
    // Подготовленный запрос для безопасного извлечения пользователя
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :email");
    $stmt->execute([
        ':email' => $email,
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $user_id = $user['id'];
        setcookie('user_id', $user_id, [
            'expires' => strtotime('+35 days'),// 360 дней
            'path' => '/', // Доступен на всем сайте
            'secure' => true, // Только по HTTPS
            'httponly' => true, // Недоступен через JavaScript
            'samesite' => 'Strict' // Защита от CSRF
        ]);

        header('Location: ../profile.php');
        exit();
    } else {
        // В случае неверного логина или пароля
        $_SESSION['message'] = 'Не верный логин или пароль';
        header('Location: ../authorization.php');
        exit();
    }
} catch (PDOException $e) {
    echo 'Ошибка базы данных: ' . $e->getMessage();
}
?>