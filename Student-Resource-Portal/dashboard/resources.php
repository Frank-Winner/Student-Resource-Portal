<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/auth.php'; ?>
<?php require_once '../classes/Resource.php'; ?>
<?php require_once '../classes/Database.php'; ?>



<?php

$user_id = $_SESSION['user_id'];


$db = new Database();
$conn = $db->conn();

$getResources = new Resource($conn);

$getResources = $getResources->getUserResources($user_id);
?>







<div class="dashboard-wrapper">

    <?php require_once '../includes/sidebar.php'; ?>

    <div class="dashboard-content">

        <div class="dashboard-header d-flex justify-content-between align-items-center">

            <button
                class="mobile-menu-btn"
                id="menuToggle">

                <i class="fas fa-bars"></i>

            </button>

            <div>

                <h2 class="mb-2">
                    My Resources
                </h2>

                <p class="text-muted mb-0">
                    Manage all uploaded resources.
                </p>

            </div>

            <a href="create-resource.php" class="btn btn-primary">

                <i class="fas fa-plus me-2"></i>
                Add Resource

            </a>

        </div>

        <?php if (!empty($error)) : ?>

            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>

        <?php if (!empty($getResources)) : ?>

            <?php foreach ($getResources as $resource) : ?>

                <div class="table-card">

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>

                                <tr>

                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>File</th>
                                    <th>Date</th>
                                    <th>Actions</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td><?php echo htmlspecialchars($resource->title) ?></td>

                                    <td>
                                        <?= htmlspecialchars($resource->category) ?>
                                    </td>

                                    <td>
                                        <a href="../uploads/<?= $resource->file_name ?>"></a>
                                        <?= htmlspecialchars($resource->file_name) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($resource->created_at) ?>
                                    </td>

                                    <td>

                                        <a href="edit-resource.php?id=<?= $resource->id ?>"
                                            class="btn btn-sm btn-outline-primary">

                                            <i class="fas fa-pen"></i>

                                        </a>

                                        <button
                                            class="btn btn-sm btn-outline-danger">

                                            <a href="delete-resource.php?id=<?= $resource->id ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this resource?')">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </button>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <div class="alert alert-info">
                No resources found.
            </div>

        <?php endif; ?>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>