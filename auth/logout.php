<?php


session_start();

$userId = $_SESSION['user_id'] ?? null;

$_SESSION = [];

unset($_SESSION['csrf_token']);

if ($userId) {

    require_once '../classes/Database.php';
    require_once '../classes/User.php';

    $db = new Database();

    $conn = $db->conn();

    $userModel = new User($conn);

    $userModel->saveRememberToken(
        $userId,
        null
    );
}

setcookie(
    'remember_token',
    '',
    time() - 3600,
    '/'
);

session_destroy();

if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

header("Location: ../index.php");
exit();
