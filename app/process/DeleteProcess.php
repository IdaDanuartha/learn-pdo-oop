<?php

if(isset($_GET['id']) && isset($_GET['req'])) {
    if($_GET['req'] === 'delete') {
        require_once('../controller/PostController.php');
    
        $postController = new PostController();
        $postController->setId($_GET['id']);

        $postController->delete();
    }

}