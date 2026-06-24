<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/admin_auth.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php require_once '../classes/Database.php' ?>
<?php require_once '../classes/Resource.php' ?>

<?php

$db = new Database();

$conn = $db->conn();

$resourceModel = new Resource($conn);

if (!empty($_GET['search'])) {

    $resources = $resourceModel->searchResources(trim($_GET['search']));
} else {

    $resources = $resourceModel->getAllResources();
}

if (isset($_GET['delete'])) {

    try {

        $resourceModel->adminDeleteResource(
            (int) $_GET['delete']
        );

        header("Location: resources.php");
        exit();
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
                Manage Resources
            </h2>

            <p class="text-muted mb-0">
                View and manage all uploaded resources.
            </p>

        </div>


        <form method="GET">

            <div class="input-group">

                <span class="input-group-text">
                    <i class="fas fa-search"></i>
                </span>

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                    placeholder="Search resources...">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Search

                </button>

            </div>

        </form>

        <div class="table-card">

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>
                            <th>Title</th>
                            <th>Owner</th>
                            <th>Category</th>
                            <th>File Name</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($resources as $resource) : ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($resource->title) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($resource->fullname) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($resource->category) ?>
                                </td>


                                <td>
                                    <?= htmlspecialchars($resource->file_name) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($resource->created_at) ?>
                                </td>

                                <td>

                                    <!-- Delete button goes here later -->
                                    <button
                                        class="btn btn-sm">
                                        <a
                                            href="?delete=<?= $resource->id ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this resource permanently?')">

                                            <i class="fas fa-trash"></i>

                                        </a>


                                    </button>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>