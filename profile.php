<?php require_once('./templates/header.php');
if (!isset($_COOKIE['user_id'])) {
    header('Location: /');
}

$user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

// Получаем текущие данные пользователя
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Получаем статистику подписчиков
$stmt = $pdo->prepare("SELECT COUNT(*) FROM subscribes WHERE author_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$subscribers_count = $stmt->fetchColumn();

// Получаем количество подписок
$stmt = $pdo->prepare("SELECT COUNT(*) FROM subscribes WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$subscriptions_count = $stmt->fetchColumn();

// Получаем количество постов
$stmt = $pdo->prepare("SELECT COUNT(*) FROM posts WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$posts_count = $stmt->fetchColumn();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="<?= $user['avatar'] ? $user['avatar'] : 'assets/img/default-avatar.png' ?>" alt="Аватар"
                        class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                    <h3><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></h3>
                    <p class="text-muted"><?= htmlspecialchars($user['email']) ?></p>

                    <a href="edit_profile.php" class="btn btn-primary mb-3">Редактировать профиль</a>

                    <div class="row text-center mt-3">
                        <div class="col">
                            <h5><?= $subscribers_count ?></h5>
                            <small class="text-muted">Подписчиков</small>
                        </div>
                        <div class="col">
                            <h5><?= $subscriptions_count ?></h5>
                            <small class="text-muted">Подписок</small>
                        </div>
                        <div class="col">
                            <h5><?= $posts_count ?></h5>
                            <small class="text-muted">Постов</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Быстрые ссылки</h4>
                    <div class="list-group">
                        <a href="my_posts.php" class="list-group-item list-group-item-action">
                            Мои посты
                        </a>
                        <a href="from_subscriptions.php" class="list-group-item list-group-item-action">
                            Посты из подписок
                        </a>
                        <a href="add_post.php" class="list-group-item list-group-item-action">
                            Создать новый пост
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('./templates/footer.php'); ?>