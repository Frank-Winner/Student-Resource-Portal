<?php

require_once '../classes/Database.php';
require_once '../classes/User.php';

$db = new Database();

$conn = $db->conn();

$userModel =
    new User($conn);

try {

    if (
        empty($_GET['token'])
    ) {

        throw new Exception(
            "Invalid verification link."
        );
    }

    $userModel->verifyEmail(
        $_GET['token']
    );

    $success =
        "Email verified successfully.";
} catch (Exception $e) {

    $error =
        $e->getMessage();
}

?>

<?php if (!empty($error)) : ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)) : ?>
    <div class="alert alert-success">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<?php header('Location: login.php
') ?>