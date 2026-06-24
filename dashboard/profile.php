<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/auth.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php
require_once '../classes/Database.php';
require_once '../classes/User.php';

$user_id = $_SESSION['user_id'];

try {

    $db = new Database();

    $conn = $db->conn();

    $userModel = new User($conn);

    // Load current user for form population
    $user = $userModel->getUserById($user_id);

    // Handle profile update
    if (isset($_POST['update_profile'])) {

        validateCsrfToken(
            $_POST['csrf_token']
        );

        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $image = $_FILES['profile_image'];

        $userModel->updateProfile(
            $user_id,
            $fullname,
            $email,
            $image
        );

        // Refresh displayed user data
        $user = $userModel->getUserById($user_id);

        $success = "Profile updated successfully.";
    }
} catch (Exception $e) {

    $error = $e->getMessage();
}
?>

<div class="dashboard-wrapper">

    <?php require_once '../includes/sidebar.php'; ?>

    <div class="dashboard-content">

        <div class="dashboard-header">

            <button
                class="mobile-menu-btn"
                id="menuToggle">

                <i class="fas fa-bars"></i>

            </button>

            <h2 class="mb-2">
                My Profile
            </h2>

            <p class="text-muted mb-0">
                Update your personal information and profile picture.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-lg-4">

                <div class="profile-card text-center">

                    <img
                        src="../storage/profile-images/<?= htmlspecialchars($user->profile_image) ?>"
                        alt="Profile Image"
                        class="profile-image">

                    <h5 class="mt-3 mb-1">
                        <?= htmlspecialchars($user->fullname) ?>
                    </h5>

                    <p class="text-muted">
                        <?= htmlspecialchars($user->email) ?>
                    </p>

                </div>

            </div>

            <div class="col-lg-8">

                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= htmlspecialchars($error) ?>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (!empty($success)) : ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= htmlspecialchars($success) ?>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>
                    </div>
                <?php endif; ?>

                <div class="form-card">

                    <form
                        action="<?= $_SERVER['PHP_SELF'] ?>"
                        method="POST"
                        enctype="multipart/form-data">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= generateCsrfToken(); ?>">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="fullname"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user->fullname) ?>">

                            </div>

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="<?= htmlspecialchars($user->email) ?>">

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Profile Picture
                            </label>

                            <input
                                type="file"
                                name="profile_image"
                                class="form-control">

                        </div>

                        <button
                            name="update_profile"
                            type="submit"
                            class="btn btn-primary">

                            <i class="fas fa-floppy-disk me-2"></i>
                            Update Profile

                        </button>

                    </form>

                </div>

            </div>

        </div>
        <div class="danger-card mt-4">

            <h4 class="text-danger mb-3">

                <i class="fas fa-triangle-exclamation me-2"></i>
                Danger Zone

            </h4>

            <p class="text-muted">

                Permanently delete your account and all
                associated resources.

            </p>

            <hr>

            <button
                type="button"
                class="btn btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#deleteAccountModal">

                <i class="fas fa-trash me-2"></i>
                Delete Account

            </button>

        </div>

    </div>

</div>

<div
    class="modal fade"
    id="deleteAccountModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-danger">

                    Delete Account

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p>

                    This action cannot be undone.

                </p>

                <p>

                    All uploaded resources and account
                    information will be permanently deleted.

                </p>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <button
                    type="button"
                    class="btn btn-danger">
                    <a href="delete-account.php" style="color: white;">
                        Permanently Delete
                    </a>

                </button>

            </div>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>