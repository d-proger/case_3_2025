<?php
$dsn = "mysql:host=127.127.126.50;dbname=case_3;charset=utf8mb4";
$user = "root";
$pass = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Включаем исключения для обработки ошибок
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // По умолчанию выбираем ассоциативные массивы
    PDO::ATTR_EMULATE_PREPARES => false, // Отключаем эмуляцию подготовленных запросов
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);


} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
