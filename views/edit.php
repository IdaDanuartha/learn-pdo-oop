<?php
    require_once('../app/controller/PostController.php');

    $postController = new PostController();
    $postController->setId($_GET['id']);

    $post = $postController->edit()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Form Data</h1>
    <form action="../app/process/UpdateProcess.php" method="post">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="<?= $post['title'] ?>">
        </div>
        <div>
            <label for="category">Category</label>
            <input type="text" name="category" value="<?= $post['category'] ?>">
        </div>
        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content" cols="30" rows="10"><?= $post['content'] ?></textarea>
        </div>
        <button type="submit" name="update">Update post</button>
    </form>
</body>
</html>