<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/admin_auth.php'; ?>


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

            <form action="" method="POST">

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