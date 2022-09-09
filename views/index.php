<?php
    session_start();

    if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"])) {
        header("Location: auth/login.php");
        exit;
    }

    require_once('../app/controller/PostController.php');
    $postController = new PostController();
    $posts = $postController->fetchAll();

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
    <div>
        <a href="../app/process/auth/LogoutProcess.php">Logout</a>
        <h2>Welcome, <?= $_SESSION['username'] ?></h2>
        <a href="create.php">Tambah Data</a>
    </div>
    <table border="1" cellpadding="10" style="margin-top: 10px">
        <tr>
            <td>Id</td>
            <td>Title</td>
            <td>Category</td>
            <td>Content</td>
            <td>Action</td>
        </tr>
        <?php foreach($posts as $key => $value) : ?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['title'] ?></td>
                <td><?= $value['category'] ?></td>
                <td><?= $value['content'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $value['id'] ?>">Edit</a>
                    <a href="../app/process/DeleteProcess.php?id=<?= $value['id'] ?>&req=delete" onclick="return confirm('Are you sure')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>