<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/admin_auth.php';
require_once '../includes/csrf.php';

require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../classes/Resource.php';

$db = new Database();

$conn = $db->conn();

$userModel = new User($conn);

$resourceModel = new Resource($conn);

$totalUsers = $userModel->getTotalUsers();

$totalAdmins = $userModel->getTotalAdmins();

$verifiedUsers = $userModel->getVerifiedUsers();

$totalResources = $resourceModel->getTotalResources();

$recentUsers = $userModel->getRecentUsers();

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

                    <h3><?= $totalUsers ?></h3>

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

                    <h3><?= $totalResources ?></h3>

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

                    <h3><?= $totalAdmins ?></h3>

                    <p class="text-muted mb-0">
                        Administrators
                    </p>

                </div>

            </div>

        </div>

        <div class="form-card mt-4">

            <h5 class="mb-3">
                Recent Users
            </h5>

            <?php foreach ($recentUsers as $user) : ?>

                <div class="border-bottom py-2">

                    <strong>
                        <?= htmlspecialchars($user->fullname) ?>
                    </strong>

                    <br>

                    <small class="text-muted">
                        <?= htmlspecialchars($user->email) ?>
                    </small>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>