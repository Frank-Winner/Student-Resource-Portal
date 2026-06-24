<?php

require_once '../includes/auth.php';

require_once '../classes/Database.php';
require_once '../classes/Resource.php';

if (!isset($_GET['id'])) {

    header("Location: ../404.php");
    exit();
}

$user_id =
    $_SESSION['user_id'];

$id =
    (int) $_GET['id'];

try {

    $db =
        new Database();

    $conn =
        $db->conn();

    $resourceModel =
        new Resource($conn);

    $resource =
        $resourceModel
        ->getResourceById(
            $id,
            $user_id
        );

    if (!$resource) {

        header("Location: ../403.php");
        exit();
    }

    $file =
        dirname(__DIR__)
        . '/storage/resources/'
        . $resource->file_name;

    if (!file_exists($file)) {

        header("Location: ../404.php");
        exit();
    }

    header(
        'Content-Type: application/octet-stream'
    );

    header(
        'Content-Disposition: attachment; filename="'
            . basename($file)
            . '"'
    );

    readfile($file);

    exit();
} catch (Exception $e) {

    header("Location: ../403.php");
    exit();
}
