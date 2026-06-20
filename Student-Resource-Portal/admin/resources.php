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
                Manage Resources
            </h2>

            <p class="text-muted mb-0">
                View and manage all uploaded resources.
            </p>

        </div>

        <div class="table-card">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>PHP Fundamentals</td>

                            <td>John Doe</td>

                            <td>Programming</td>

                            <td>Jul 20, 2026</td>

                            <td>

                                <button
                                    class="btn btn-sm btn-outline-danger">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </td>

                        </tr>

                        <tr>

                            <td>Bootstrap Guide</td>

                            <td>Jane Smith</td>

                            <td>Frontend</td>

                            <td>Jul 18, 2026</td>

                            <td>

                                <button
                                    class="btn btn-sm btn-outline-danger">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>