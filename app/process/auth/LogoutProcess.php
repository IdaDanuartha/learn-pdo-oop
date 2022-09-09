<?php

session_start();
session_destroy();

echo "<script>alert('User logged out'); document.location.href='../../../views/auth/login.php';</script>";
