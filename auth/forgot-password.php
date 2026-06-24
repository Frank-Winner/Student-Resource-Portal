<?php

require_once '../includes/header.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../includes/csrf.php';

if (isset($_POST['submit'])) {

    $email =
        trim($_POST['email']);

    try {

        $db =
            new Database();

        $conn =
            $db->conn();

        $user =
            new User($conn);

        $user->sendPasswordResetLink(
            $email
        );

        $success =
            "Password reset link sent to your email.";
    } catch (Exception $e) {

        $error =
            $e->getMessage();
    }
}

?>

<div class="auth-wrapper">

    <div class="auth-card">

        <h2 class="mb-4 text-center">
            Forgot Password
        </h2>

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

        <form method="POST">

            <input
                type="hidden"
                name="csrf_token"
                value="<?= generateCsrfToken(); ?>">

            <div class="mb-3">

                <label class="form-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Enter your email">

            </div>

            <button
                name="submit"
                type="submit"
                class="btn btn-primary w-100">

                Send Reset Link

            </button>

        </form>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>