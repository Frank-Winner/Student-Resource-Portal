<?php

require_once '../classes/Database.php';
require_once '../classes/User.php';

if (
    !isset($_SESSION['user_id'])
    &&
    isset($_COOKIE['remember_token'])
) {

    $db = new Database();

    $conn = $db->conn();

    $userModel =
        new User($conn);

    $user =
        $userModel
        ->getUserByRememberToken(
            $_COOKIE['remember_token']
        );

    if ($user) {

        $_SESSION['user_id'] =
            $user->id;

        $_SESSION['role'] =
            $user->role;
    }
}
