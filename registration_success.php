<?php require_once('./templates/header.php');
if (isset($_COOKIE['user_id'])) {
    header('Location: /');
}

if (isset($_SESSION['message']) && $_SESSION['message'] === 'registration_success'): ?>
    <h4 class="msg"> Регистрация прошла успешно!</h4>
    <div><a href="/authorization.php">Войти</a></div>

    <?php
    unset($_SESSION['message']);
else:
    header('Location: /');
endif;
?>


<?php require_once('./templates/footer.php'); ?>