<?php require_once('./templates/header.php');
if (isset($_COOKIE['user_id'])) {
    header('Location: /');
}
?>

<div class="form-container">
    <?php
    if (isset($_SESSION['message'])) {
        echo '<h4 class="msg"> ' . $_SESSION['message'] . ' </h4>';
        unset($_SESSION['message']);
    }

    ?>
    <!-- Форма регистрации -->
    <div id="register-form" class="form">
        <h2>Регистрация</h2>
        <form action="./vendor/signup.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="register-firstname">Имя</label>
                <input type="text" id="register-firstname" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="register-lastname">Фамилия</label>
                <input type="text" id="register-lastname" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="register-email">Email</label>
                <input type="email" id="register-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="register-password">Пароль</label>
                <input type="password" id="register-password" name="password" required>
            </div>
            <div class="form-group">
                <label for="register-password_confirm">Повторите Пароль</label>
                <input type="password" id="register-password_confirm" name="password_confirm" required>
            </div>
            <div class="form-group">
                <label for="register-avatar">Аватар</label>
                <input type="file" id="register-avatar" name="avatar" accept="image/*">
            </div>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="/authorization.php">Войдите</a></p>
    </div>
</div>


<?php require_once('./templates/footer.php'); ?>