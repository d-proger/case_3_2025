<?php require_once('./templates/header.php');

if (isset($_GET['id'])) {
    $author_id = $_GET['id'];
} else {
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
}
if (!isset($_COOKIE['user_id'])) {
    header('Location: /');
}

$user_id = $_COOKIE['user_id'];

// Получаем информацию об авторе
$stmt = $pdo->prepare("SELECT id, first_name, last_name, email, avatar FROM users WHERE id = :author_id");
$stmt->execute(['author_id' => $author_id]);
$author = $stmt->fetch(PDO::FETCH_ASSOC);

// Проверяем, подписан ли текущий пользователь на автора
$stmt = $pdo->prepare("SELECT id FROM subscribes WHERE author_id = :author_id AND user_id = :user_id");
$stmt->execute([
    'author_id' => $author_id,
    'user_id' => $user_id
]);
$isSubscribed = $stmt->fetch();

// Обработка подписки/отписки
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'subscribe') {
        $stmt = $pdo->prepare("INSERT INTO subscribes (author_id, user_id) VALUES (:author_id, :user_id)");
        $stmt->execute([
            'author_id' => $author_id,
            'user_id' => $user_id
        ]);
        header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $author_id);
    } elseif ($_POST['action'] === 'unsubscribe') {
        $stmt = $pdo->prepare("DELETE FROM subscribes WHERE author_id = :author_id AND user_id = :user_id");
        $stmt->execute([
            'author_id' => $author_id,
            'user_id' => $user_id
        ]);
        header('Location: ' . $_SERVER['PHP_SELF'] . '?id=' . $author_id);
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">Страница автора</h1>
                    <?php if ($author): ?>
                        <div class="author-info">
                            <img src="<?= $author['avatar'] ? $author['avatar'] : 'assets/img/default-avatar.png' ?>"
                                alt="Аватар" class="rounded-circle" style="width: 100px; height: 100px;">
                            <h2><?= htmlspecialchars($author['first_name'] . ' ' . $author['last_name']) ?></h2>
                            <p>Email: <?= htmlspecialchars($author['email']) ?></p>

                            <?php if ($user_id != $author_id): ?>
                                <form method="POST">
                                    <?php if (!$isSubscribed): ?>
                                        <button type="submit" name="action" value="subscribe" class="btn btn-primary">
                                            Подписаться
                                        </button>
                                    <?php else: ?>
                                        <button type="submit" name="action" value="unsubscribe" class="btn btn-secondary">
                                            Отписаться
                                        </button>
                                    <?php endif; ?>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <p>Автор не найден</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once('./templates/footer.php'); ?>