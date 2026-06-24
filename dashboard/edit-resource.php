<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/auth.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php require_once '../classes/Resource.php'; ?>
<?php require_once '../classes/Database.php'; ?>
<?php require_once '../classes/Database.php'; ?>

<?php

$user_id = $_SESSION['user_id'];

if (!isset($_GET['id'])) {
    header("Location: ../404.php");
    exit();
}

$id = $_GET['id'];



try {
    $db = new Database();
    $conn = $db->conn();

    $resourceModel = new Resource($conn);

    $resource = $resourceModel->getResourceById($id, $user_id);
} catch (Exception $e) {
    die($e->getMessage());
}

if (isset($_POST['update'])) {

    validateCsrfToken(
        $_POST['csrf_token']
    );

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $file = $_FILES['resource_file'];

    try {
        $resourceModel->updateResource(
            $id,
            $user_id,
            $title,
            $category,
            $description,
            $file
        );

        header("Location: resources.php");
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

            <button
                class="mobile-menu-btn"
                id="menuToggle">

                <i class="fas fa-bars"></i>

            </button>

            <h2 class="mb-2">
                Edit Resource
            </h2>

            <p class="text-muted mb-0">
                Update information about an existing resource.
            </p>

        </div>

        <div class="form-card">

            <form
                action="<?= $_SERVER['PHP_SELF'] . '?id=' . $id ?>"
                method="POST"
                enctype="multipart/form-data">

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= generateCsrfToken(); ?>">

                <div class="mb-3">

                    <label class="form-label">
                        Resource Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="<?= htmlspecialchars($resource->title) ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Category
                    </label>

                    <select
                        name="category"
                        class="form-select">

                        <option value="Programming"
                            <?= $resource->category == "Programming" ? "selected" : "" ?>>
                            Programming
                        </option>

                        <option value="Frontend"
                            <?= $resource->category == "Frontend" ? "selected" : "" ?>>
                            Frontend
                        </option>

                        <option value="Backend"
                            <?= $resource->category == "Backend" ? "selected" : "" ?>>
                            Backend
                        </option>

                        <option value="Database"
                            <?= $resource->category == "Database" ? "selected" : "" ?>>
                            Database
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control"><?= htmlspecialchars($resource->description) ?></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Current File
                    </label>

                    <div class="alert alert-light border">
                        <?= htmlspecialchars($resource->file_name) ?>
                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Replace File (Optional)
                    </label>

                    <input
                        type="file"
                        name="resource_file"
                        class="form-control">

                </div>

                <div class="d-flex gap-2 flex-wrap">

                    <button
                        name="update"
                        type="submit"
                        class="btn btn-primary">

                        <i class="fas fa-floppy-disk me-2"></i>
                        Save Changes

                    </button>

                    <a
                        href="resources.php"
                        class="btn btn-outline-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


<?php require_once '../includes/footer.php'; ?>