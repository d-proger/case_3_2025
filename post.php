<?php require_once('./templates/header.php');
// Определяем текущую страницу
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
} else {
    header('Location: /');
    exit;
}
$user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : null;
// Подготавливаем SQL-запрос с пагинацией
$stmt = $pdo->prepare("SELECT * FROM `posts` WHERE id=:id LIMIT 1 ");
$stmt->bindValue(':id', $post_id, PDO::PARAM_INT);
$stmt->execute();

// Получаем посты для текущей страницы
$post = $stmt->fetch(PDO::FETCH_ASSOC);
if ($post === false) {
    header('Location: /');
    exit;
}

if (isset($_SESSION['message'])) {
    echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
    unset($_SESSION['message']);
}

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

$post_id = $post['id'];
if ($post['on_request'] == 1 || $post['user_id'] == $user_id || $request_status == 1): ?>
    <!-- выводим пост -->
    <section>
        <div class="post">
            <div class="img"><img src="<?= $post['post_img'] ?>" alt="<?= $post['title'] ?>"></div>
            <h1><?= $post['title'] ?></h1>
            <p><?= $post['content'] ?></p>

        </div>


    </section>
<?php else:

    // Проверяем, найдена ли запись
    if ($request_status === false) {
        ?>
        <div class="more"><a href="/vendor/on_request.php?post_id=<?= $post['id'] ?>">Запросить
                доступ</a>
        </div>
        <?php
    } else if ($request_status == 0) {
        ?>
            <div class="more"><a href="#">Запрос на рассмотрении</a>
            </div>
        <?php

    }
endif ?>
<div class="author"><a href="/author.php?id=<?= $post['user_id'] ?>">Смотреть автора</a></div>
<!-- добавить комментарий -->
<div class="form-container">
    <h1>Добавить комментарий</h1>
    <div id="add-post-form" class="form">

        <form action="./vendor/add_comment.php" method="POST">
            <div class="form-group">
                <textarea name="content" id="comment"></textarea>
            </div>
            <input type="hidden" name="post_id" value="<?= $post_id ?>">


            <button type="submit">Добавить</button>
        </form>
    </div>
</div>

<!-- все комментарии поста -->

<?php
// получаем комментарии поста с данными о пользователе

$sql = "
    SELECT 
        c.id AS comment_id, 
        c.content, 
        u.id AS user_id, 
        u.first_name, 
        u.last_name 
    FROM comments c
    JOIN users u ON c.user_id = u.id
    WHERE c.post_id = :post_id
";
$stmt = $pdo->prepare($sql);
$stmt->execute(['post_id' => $post_id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<h2>Комментарии к посту</h2>
<div class="comments">
    <?php foreach ($comments as $comment): ?>
        <div class="comment">
            <div class="name"><?= $comment['first_name'] ?></div>
            <div class="content"><?= $comment['content'] ?></div>
        </div>
    <?php endforeach ?>
</div>




<?php require_once('./templates/footer.php'); ?>