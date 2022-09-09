<?php
session_start();
if(isset($_POST['login'])) {
    require_once('../../controller/LoginController.php');
    
    $loginController = new LoginController();

    $loginController->setEmail($_POST['email']);
    $loginController->setPassword($_POST['password']);

    $loginController->login();

}