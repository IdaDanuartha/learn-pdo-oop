<?php

if(isset($_POST['register'])) {
    require_once('../../controller/RegisterController.php');
    
    $registerController = new RegisterController();

    $registerController->setUsername($_POST['username']);
    $registerController->setEmail($_POST['email']);
    $registerController->setPassword($_POST['password']);

    $registerController->checkUser($_POST['email']);

}