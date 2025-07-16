<?php
session_start();
require_once 'connect.php';

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password !== $password_confirm) {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../registration.php');
    exit();
}

// Проверяем, существует ли уже такой email
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
$stmt->execute([':email' => $email]);
$emailExists = $stmt->fetchColumn();

if ($emailExists > 0) {
    $_SESSION['message'] = 'Этот e-mail уже зарегистрирован';
    header('Location: ../registration.php');
    exit();
}

// Проверяем загрузку файла
if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
    $upload_dir = '../uploads/';
    $filename = time() . basename($_FILES['avatar']['name']);
    $target_path = $upload_dir . $filename;

    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $target_path)) {
        $_SESSION['message'] = 'Ошибка при загрузке файла';
        header('Location: ../registration.php');
        exit();
    }
    $avatar_path = 'uploads/' . $filename;
} else {
    $avatar_path = 'uploads/default.png';
}

// Хешируем пароль
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Добавляем нового пользователя
try {
    $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, avatar) VALUES (:first_name, :last_name, :email, :password, :avatar)");
    $stmt->execute([
        ':first_name' => $first_name,
        ':last_name' => $last_name,
        ':email' => $email,
        ':password' => $password_hashed,
        ':avatar' => $avatar_path
    ]);

    $_SESSION['message'] = 'registration_success';
    header('Location: ../registration_success.php');
    exit();
} catch (PDOException $e) {
    $_SESSION['message'] = 'Ошибка при регистрации: ' . $e->getMessage();
    header('Location: ../registration.php');
    exit();
}
