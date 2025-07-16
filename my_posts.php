<?php require_once('./templates/header.php');
// Определяем текущую страницу
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$perPage = 1; // Количество постов на странице
$offset = ($page - 1) * $perPage; // Смещение для SQL-запроса
// Подготавливаем SQL-запрос с пагинацией
$stmt = $pdo->prepare("SELECT * FROM `posts` WHERE user_id = :user_id LIMIT :limit OFFSET :offset");
$user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;
// Явно указываем типы данных для LIMIT и OFFSET
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

// Выполняем запрос
$stmt->execute();

// Получаем посты для текущей страницы
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Получаем общее количество постов для расчета количества страниц
$totalStmt = $pdo->prepare("SELECT COUNT(*) FROM `posts` WHERE user_id = :user_id");
$totalStmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$totalStmt->execute(); // Выполняем запрос
$totalPosts = $totalStmt->fetchColumn(); // Получаем результат
$totalPages = ceil($totalPosts / $perPage); // Рассчитываем количество страниц
?>

<?php
if (isset($_SESSION['message'])) {
    echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    unset($_SESSION['message']);
}

?>

<section>
    <h2>Все посты</h2>
    <div class="content-page-flex posts col">
        <?php
        // Выводим посты
        foreach ($posts as $post):
            $short_content = mb_substr($post['content'], 0, 100, 'UTF-8');

            ?>
            <div class="post">
                <div class="img"><img src="<?= $post['post_img'] ?>" alt="<?= $post['title'] ?>"></div>
                <h3><?= $post['title'] ?></h3>
                <p><?= $short_content ?></p>
                <div class="btns">
                    <a class="link btn-more" href="/post.php?id=<?= $post['id'] ?>">Читать</a>
                    <a class="link btn-delete" href="/vendor/post_delete.php?id=<?= $post['id'] ?>">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    // Выводим постраничную навигацию
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page) {
            echo "<strong>$i</strong> ";
        } else {
            echo "<a href='?page=$i'>$i</a> ";
        }
    }

    ?>
</section>

<?php require_once('./templates/footer.php'); ?>