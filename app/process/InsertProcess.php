<?php

if(isset($_POST['insert'])) {
    require_once('../controller/PostController.php');
    
    $postController = new PostController();

    $postController->setTitle($_POST['title']);
    $postController->setCategory($_POST['category']);
    $postController->setContent($_POST['content']);
    $postController->setCreated_at(date('Y-m-d H:i:s'));
    $postController->setUpdated_at(date('Y-m-d H:i:s'));

    $postController->store();

}