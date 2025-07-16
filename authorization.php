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
    <!-- Форма авторизации -->
    <div id="login-form" class="form">
        <h2>Авторизация</h2>
        <form method="POST" action="./vendor/signin.php">
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Пароль</label>
                <input type="password" id="login-password" name="password" required>
            </div>
            <button type="submit">Войти</button>
        </form>
        <p>Нет аккаунта? <a href="/registration.php">Зарегистрируйтесь</a></p>
    </div>

</div>

<?php require_once('./templates/footer.php'); ?>