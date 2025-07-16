<?php require_once('./templates/header.php');

// Определяем текущую страницу
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$perPage = 1; // Количество постов на странице
$offset = ($page - 1) * $perPage; // Смещение для SQL-запроса
$user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;

// Фильтр по тегу
$tagFilter = isset($_GET['tag']) ? $_GET['tag'] : null;

// Подготавливаем SQL-запрос с пагинацией и фильтром по тегу
$sql = "
    SELECT p.*, GROUP_CONCAT(t.name) as tags 
    FROM posts p
    LEFT JOIN post_tags pt ON p.id = pt.post_id
    LEFT JOIN tags t ON pt.tag_id = t.id
";

if ($tagFilter) {
    $sql .= " WHERE t.name = :tag";
}

$sql .= " GROUP BY p.id LIMIT :limit OFFSET :offset";

$stmt = $pdo->prepare($sql);

if ($tagFilter) {
    $stmt->bindValue(':tag', $tagFilter, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

// Получаем посты для текущей страницы
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Получаем общее количество постов для расчета количества страниц
$totalStmt = $pdo->prepare("SELECT COUNT(DISTINCT p.id) FROM posts p LEFT JOIN post_tags pt ON p.id = pt.post_id LEFT JOIN tags t ON pt.tag_id = t.id" . ($tagFilter ? " WHERE t.name = :tag" : ""));
if ($tagFilter) {
    $totalStmt->bindValue(':tag', $tagFilter, PDO::PARAM_STR);
}
$totalStmt->execute();
$totalPosts = $totalStmt->fetchColumn();
$totalPages = ceil($totalPosts / $perPage);
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
            $post_id = $post['id'];
            ?>
            <div class="post">
                <div class="img"><img src="<?= $post['post_img'] ?>" alt="<?= $post['title'] ?>"></div>
                <h3><?= $post['title'] ?></h3>
                <p><?= $short_content ?></p>
                <?php if (!empty($post['tags'])): ?>
                    <div class="tags">
                        Теги: <?= htmlspecialchars($post['tags']) ?>
                    </div>
                <?php endif; ?>
                <?php if ($post['on_request'] == 1 || $post['user_id'] == $user_id): ?>
                    <div class="more"><a href="post.php?id=<?= $post['id'] ?>">Читать</a></div>
                <?php else:
                    // Подготовка запроса
                    $sql = "SELECT request_status FROM on_requests WHERE user_id = :user_id AND post_id = :post_id LIMIT 1";
                    $stmt = $pdo->prepare($sql);

                    // Подставляем значения
                    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);

                    // Выполняем запрос
                    $stmt->execute();

                    // Получаем результат
                    $request_status = $stmt->fetchColumn();
                    // Проверяем, найдена ли запись
                    if ($request_status === false) {
                        ?>
                        <div class="more"><a href="/vendor/on_request.php?post_id=<?= $post['id'] ?>">Запросить доступ</a></div>
                        <?php
                    } else {
                        if ($request_status == 1) {
                            ?>
                            <div class="more"><a href="post.php?id=<?= $post['id'] ?>">Одобрено: Читать</a></div>
                            <?php
                        } else {
                            ?>
                            <div class="more"><a href="#">Запрос на рассмотрении</a></div>
                            <?php
                        }
                    }
                    ?>
                <?php endif ?>
                <div class="author"><a href="/author.php?id=<?= $post['user_id'] ?>">Смотреть автора</a></div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php
    // Выводим постраничную навигацию
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page) {
            echo "<strong>$i</strong> ";
        } else {
            echo "<a href='?page=$i" . ($tagFilter ? "&tag=$tagFilter" : "") . "'>$i</a> ";
        }
    }
    ?>
</section>

<?php require_once('./templates/footer.php'); ?>