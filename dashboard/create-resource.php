<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/auth.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php require_once '../classes/Resource.php'; ?>
<?php require_once '../classes/Database.php'; ?>





<?php

// session_start();

$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {

    validateCsrfToken(
        $_POST['csrf_token']
    );

    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    $file = $_FILES['upload'];

    try {
        $db = new Database();
        $conn = $db->conn();

        $createResource = new Resource($conn);

        $createResource->createResource($user_id, $title, $category, $description, $file);

        $success = "File uploaded!";
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
                Upload Resource
            </h2>

            <p class="text-muted mb-0">
                Add a new learning resource.
            </p>

        </div>

        <div class="form-card">

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

            <form
                action="<?php echo $_SERVER['PHP_SELF']; ?>"
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
                        placeholder="Enter resource title">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Category
                    </label>

                    <select
                        name="category"
                        class="form-select">

                        <option value="">
                            Select Category
                        </option>

                        <option value="Programming">
                            Programming
                        </option>

                        <option value="Frontend">
                            Frontend
                        </option>

                        <option value="Backend">
                            Backend
                        </option>

                        <option value="Database">
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
                        class="form-control"
                        placeholder="Enter resource description"></textarea>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Upload File
                    </label>

                    <input
                        type="file"
                        name="upload"
                        class="form-control">

                </div>

                <button
                    name="submit"
                    type="submit"
                    class="btn btn-primary">

                    <i class="fas fa-cloud-arrow-up me-2"></i>
                    Upload Resource

                </button>

            </form>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>