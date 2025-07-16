<?php
function get_user($id, $get = false)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, first_name, last_name,email, avatar FROM `users` WHERE `id` = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($get === true) {
        return $user;
    } else {
        $_SESSION['user'] = [
            "id" => $user['id'],
            "first_name" => $user['first_name'],
            "last_name" => $user['last_name'],
            "avatar" => $user['avatar'],
            "email" => $user['email']
        ];
    }

}