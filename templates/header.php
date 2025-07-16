<?php
session_start();
require_once './vendor/connect.php';
require_once './functions.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наш блог</title>
    <link rel="icon" href="img/favicon.png" type="image/png ">
    <link rel="stylesheet" href="./../assets/style.css">
</head>

<body>
    <?php
    if (isset($_COOKIE['user_id']) && !isset($_SESSION['user'])) {
        // получаем пользователя по ID и записывает данные в сессию,  true вторым параметром, тогда будет return двнных
        get_user($_COOKIE['user_id']);
    }
    // var_dump($_SESSION['user']);
    ?>
    <header class="header">
        <div class="container">
            <div class="header-flex">
                <div class="logo">
                    <img src="./../assets/img/logo.png" alt="Логотип">
                    <div class="logo-text">
                        <h2>Наш блог</h2>
                        <span>Пиши, читай</span>
                    </div>
                </div>
                <div class="info">Сегодня <span class="date-js">15.02.16!</span></div>
                <div class="header-nav">
                    <?php if (isset($_COOKIE['user_id'])): ?>
                        <span class="name">
                            <a href="/profile.php" class="profile-link">
                                <?= htmlspecialchars($_SESSION['user']['first_name']) ?>
                            </a>
                        </span>
                        <a href="vendor/logout.php" class="logout">Выход</a>
                    <?php else: ?>
                        <a href="authorization.php">Войти</a>
                        <a href="registration.php">Регистрация</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <nav class="nav-top">
        <div class="container">
            <ul class="menu-top">
                <li><a href="/">Все посты</a></li>
                <?php if (isset($_COOKIE['user_id'])): ?>
                    <li><a href="/from_subscriptions.php">Из подписок</a></li>
                    <li><a href="/my_posts.php">Мои посты</a></li>
                    <li><a href=/add_post.php>Добавить пост</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="content-flex">
            <?php
            switch (basename($_SERVER['PHP_SELF'])):
                case 'index.php':
                case 'from_subscriptions.php':
                    ?>
                    <aside class="news-sadebar">
                        <h2>Новости</h2>
                        <div class="tags-filter">
                            <h3>Фильтр по тегам:</h3>
                            <?php
                            $tagsStmt = $pdo->query("SELECT name FROM tags");
                            $tags = $tagsStmt->fetchAll(PDO::FETCH_COLUMN);
                            foreach ($tags as $tag):
                                ?>
                                <a href="?tag=<?= urlencode($tag) ?>" class="tag"><?= htmlspecialchars($tag) ?></a>
                            <?php endforeach; ?>
                            <a href="?" class="tag">Все посты</a>
                        </div>


                    </aside>
                    <?php
                    break;
                default:
                    $add_class = 'w_100';
            endswitch;
            ?>
            <main class="content-page <?= $add_class ?>">