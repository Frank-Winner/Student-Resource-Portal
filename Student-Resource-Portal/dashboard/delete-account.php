<?php
require_once '../includes/header.php';
require_once '../includes/auth.php';
require_once '../classes/Database.php';
require_once '../classes/User.php';

$user_id = $_SESSION['user_id'];

$db = new Database();
$conn = $db->conn();

$userModel = new User($conn);

if (isset($_POST['delete_account'])) {

    $password = trim($_POST['password']);

    try {

        $userModel->deleteAccount($user_id, $password);

        header("Location: ../index.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>

<div class="dashboard-wrapper">

    <?php require_once '../includes/sidebar.php'; ?>

    <div class="dashboard-content">

        <div class="dashboard-header">

            <button class="mobile-menu-btn" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>

            <h2 class="mb-2">Delete Account</h2>

            <p class="text-muted mb-0">
                This action is permanent and cannot be undone.
            </p>

        </div>

        <div class="form-card">

            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?= htmlspecialchars($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">
                        Confirm Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password to confirm">

                    </div>

                </div>

                <button
                    type="submit"
                    name="delete_account"
                    class="btn btn-danger w-100">

                    <i class="fas fa-trash-alt me-2"></i>
                    Permanently Delete Account

                </button>

            </form>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>