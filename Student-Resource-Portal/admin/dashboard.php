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
                Admin Dashboard
            </h2>

            <p class="text-muted mb-0">
                Overview of users, resources and platform activity.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <h3>125</h3>

                    <p class="text-muted mb-0">
                        Total Users
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>

                    <h3>348</h3>

                    <p class="text-muted mb-0">
                        Total Resources
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>

                    <h3>3</h3>

                    <p class="text-muted mb-0">
                        Administrators
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>