<?php

session_start();
if (!isset($_SESSION['auth'])) {
    header('location:login.php');
    die;
}

unset($_SESSION['auth']);
session_destroy();
header('location:login.php');
