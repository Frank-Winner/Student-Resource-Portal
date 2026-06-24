<?php
require_once '../includes/auth.php';
require_once '../classes/Database.php';
require_once '../classes/Resource.php';

$user_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    die("Invalid request");
}

$id = $_GET['id'];

try {
    $db = new Database();
    $conn = $db->conn();

    $resourceModel = new Resource($conn);

    // Optional: fetch first (to get file name)
    $resource = $resourceModel->getResourceById($id, $user_id);

    // Delete file from server
    $filePath = dirname(__DIR__) . "/uploads/" . $resource->file_name;

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Delete from database
    $resourceModel->deleteResource($id, $user_id);

    header("Location: resources.php");
    exit();
} catch (Exception $e) {
    die($e->getMessage());
}
