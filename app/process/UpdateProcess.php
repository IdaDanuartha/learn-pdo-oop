<?php

if(isset($_POST['update'])) {
    require_once('../controller/PostController.php');
    
    $postController = new PostController();

    $postController->setId($_POST['id']);
    $postController->setTitle($_POST['title']);
    $postController->setCategory($_POST['category']);
    $postController->setContent($_POST['content']);
    $postController->setUpdated_at(date('Y-m-d H:i:s'));

    $postController->update();

}