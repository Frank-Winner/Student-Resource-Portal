<?php

require_once '../includes/header.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../includes/csrf.php';

if (!isset($_GET['token'])) {

    die("Invalid request");
}

$token =
    $_GET['token'];

if (isset($_POST['submit'])) {

    try {

        $db =
            new Database();

        $conn =
            $db->conn();

        $user =
            new User($conn);

        $user->resetPassword(
            $_POST['token'],
            trim($_POST['password']),
            trim($_POST['confirm_password'])
        );

        header(
            "Location: login.php"
        );

        exit();
    } catch (Exception $e) {

        $error =
            $e->getMessage();
    }
}

?>

<div class="auth-wrapper">

    <div class="auth-card">

        <h2 class="mb-4 text-center">
            Reset Password
        </h2>

        <?php if (!empty($error)) : ?>

            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

        <form method="POST">

            <input
                type="hidden"
                name="csrf_token"
                value="<?= generateCsrfToken(); ?>">

            <input
                type="hidden"
                name="token"
                value="<?= htmlspecialchars($token) ?>">

            <div class="mb-3">

                <label class="form-label">
                    New Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="confirm_password"
                    class="form-control">

            </div>

            <button
                name="submit"
                type="submit"
                class="btn btn-primary w-100">

                Reset Password

            </button>

        </form>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>