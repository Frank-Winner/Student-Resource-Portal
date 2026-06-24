<?php

require_once '../includes/header.php';
require_once '../includes/admin_auth.php';
require_once '../includes/csrf.php';

require_once '../classes/Database.php';
require_once '../classes/User.php';

$user_id = $_SESSION['user_id'];

$db = new Database();

$conn = $db->conn();

$userModel = new User($conn);

if (isset($_POST['change_password'])) {

    validateCsrfToken(
        $_POST['csrf_token']
    );

    $current_password = trim($_POST['current_password']);

    $new_password = trim($_POST['new_password']);

    $confirm_password = trim($_POST['confirm_password']);

    try {

        $userModel->updatePassword(
            $user_id,
            $current_password,
            $new_password,
            $confirm_password
        );

        $success = "Password updated successfully.";
    } catch (Exception $e) {

        $error = $e->getMessage();
    }
}

?>


<div class="dashboard-wrapper">

    <?php require_once '../includes/sidebar-admin.php'; ?>

    <div class="dashboard-content">

        <div class="dashboard-header">

            <button
                class="mobile-menu-btn"
                id="menuToggle">

                <i class="fas fa-bars"></i>

            </button>

            <h2 class="mb-2">
                Change Password
            </h2>

            <p class="text-muted mb-0">
                Update your administrator password securely.
            </p>

        </div>

        <div class="form-card">


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

            <form action="" method="POST">

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= generateCsrfToken(); ?>">

                <div class="mb-3">

                    <label class="form-label">
                        Current Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>

                        <input
                            type="password"
                            name="current_password"
                            class="form-control"
                            placeholder="Enter current password">

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        New Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="fas fa-key"></i>
                        </span>

                        <input
                            type="password"
                            name="new_password"
                            class="form-control"
                            placeholder="Enter new password">

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Confirm New Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="fas fa-shield-halved"></i>
                        </span>

                        <input
                            type="password"
                            name="confirm_password"
                            class="form-control"
                            placeholder="Confirm new password">

                    </div>

                </div>

                <button
                    name="change_password"
                    type="submit"
                    class="btn btn-primary">


                    <i class="fas fa-floppy-disk me-2"></i>
                    Update Password

                </button>

            </form>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>