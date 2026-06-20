<?php

session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] !== 'admin') {
        header("Location: ../dashboard/index.php");
        exit();
    }
} else {
    header("Location: ../auth/login.php");
    exit();
}
