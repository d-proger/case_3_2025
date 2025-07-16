<?php require_once('./templates/header.php');
if (!isset($_COOKIE['user_id'])) {
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
    <h1>Добавить пост</h1>
    <div id="add-post-form" class="form">

        <form action="./vendor/add_post.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="post-title">Заголовок</label>
                <input type="text" id="post-title" name="title" required>
            </div>
            <div class="form-group">
                <label for="post-content">Содержимое</label>
                <textarea name="content" id="post-content"></textarea>
            </div>

            <div class="form-group">
                <h4>Тип поста:</h4>
                <div class="on_request d-flex-row">
                    <input type="radio" id="open" name="on_request" value="1" checked>
                    <label for="open">Открытый</label>
                    <input type="radio" id="closed" name="on_request" value="0">
                    <label for="closed">По запросу</label>

                </div>
            </div>
            <div class="form-group">
                <label for="post-tags">Теги (через запятую)</label>
                <input type="text" id="post-tags" name="tags">
            </div>
            <div class="form-group">
                <label for="post-img">Изображение поста</label>
                <input type="file" id="post-img" name="post_img" accept="image/*">
            </div>
            <button type="submit">Добавить</button>
        </form>
    </div>
</div>


<?php require_once('./templates/footer.php'); ?>