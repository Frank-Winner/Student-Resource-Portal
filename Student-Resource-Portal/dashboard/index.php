<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/auth.php'; ?>

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
                Dashboard
            </h2>

            <p class="text-muted mb-0">
                Welcome back. Manage your resources from one place.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>

                    <h3>12</h3>

                    <p class="text-muted mb-0">
                        Total Resources
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-download"></i>
                    </div>

                    <h3>45</h3>

                    <p class="text-muted mb-0">
                        Downloads
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <h3>1</h3>

                    <p class="text-muted mb-0">
                        Active Account
                    </p>

                </div>

            </div>

        </div>

        <div class="activity-card">

            <h5 class="mb-4">
                Recent Activity
            </h5>

            <ul class="list-group">

                <li class="list-group-item">
                    Uploaded PHP Notes.pdf
                </li>

                <li class="list-group-item">
                    Updated Profile Information
                </li>

                <li class="list-group-item">
                    Downloaded Bootstrap Guide.pdf
                </li>

            </ul>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>