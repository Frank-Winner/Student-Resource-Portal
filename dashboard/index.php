<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/auth.php'; ?>
<?php


require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../classes/Resource.php';

require_once '../classes/Database.php';
require_once '../classes/User.php';
require_once '../classes/Resource.php';

$db = new Database();

$conn = $db->conn();

$userModel = new User($conn);

$resourceModel = new Resource($conn);

$user_id = $_SESSION['user_id'];

$totalResources = $resourceModel->getUserResourceCount($user_id);

$user =
    $userModel->getUserById($user_id);

$recentResources =
    $resourceModel->getRecentUserResources(
        $user_id
    );
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

                    <h3><?= $totalResources ?></h3>

                    <p class="text-muted mb-0">
                        Total Resources
                    </p>

                </div>

                <!-- Card -->

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-user"></i>
                    </div>

                    <h3><?= ucfirst($user->role) ?></h3>

                    <p class="text-muted mb-0">
                        Account Type
                    </p>

                </div>

            </div>

            <div class="col-md-4">

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-calendar"></i>
                    </div>

                    <h3>
                        <?= date('M Y', strtotime($user->created_at)) ?>
                    </h3>

                    <p class="text-muted mb-0">
                        Date Joined
                    </p>

                </div>

            </div>

        </div>

        <div class="form-card mt-4">

            <h5 class="mb-3">
                Recent Resources
            </h5>

            <?php if (!empty($recentResources)) : ?>

                <?php foreach ($recentResources as $resource) : ?>

                    <div class="border-bottom py-2">

                        <strong>
                            <?= htmlspecialchars($resource->title) ?>
                        </strong>

                        <br>

                        <small class="text-muted">
                            <?= htmlspecialchars($resource->category) ?>
                        </small>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <p class="text-muted mb-0">
                    No resources uploaded yet.
                </p>

            <?php endif; ?>

        </div>

        <!-- <div class="activity-card">

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

        </div> -->

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>