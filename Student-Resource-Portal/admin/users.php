<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/admin_auth.php'; ?>

<?php

require_once '../classes/Database.php';
require_once '../classes/User.php';

try {

    $db = new Database();

    $conn = $db->conn();

    $userModel = new User($conn);

    // Promote
    if (isset($_GET['promote'])) {

        try {

            $userModel->promoteUser(
                (int) $_GET['promote']
            );

            $success = "User promoted successfully.";

            header("Location: users.php");
            exit();
        } catch (Exception $e) {

            $error = $e->getMessage();
        }
    }

    // Demote
    if (isset($_GET['demote'])) {

        try {

            $userModel->demoteUser(
                (int) $_GET['demote']
            );

            header("Location: users.php");
            $success = "Admin demoted successfully.";
            exit();
        } catch (Exception $e) {

            $error = $e->getMessage();
        }
    }

    // Delete
    if (isset($_GET['delete'])) {

        try {

            $userModel->adminDeleteUser(
                (int) $_GET['delete']
            );

            header("Location: users.php");

            $success = "User deleted successfully.";
            exit();
        } catch (Exception $e) {

            $error = $e->getMessage();
        }
    }

    // Search
    if (!empty($_GET['search'])) {

        $users = $userModel->searchUsers(
            trim($_GET['search'])
        );
    } else {

        $users = $userModel->getAllUsers();
    }
} catch (Exception $e) {
    $error = $e->getMessage();
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
                Manage Users
            </h2>

            <p class="text-muted mb-0">
                View and manage registered users.
            </p>

        </div>


        <!-- Search bar -->
        <div class="mb-4">

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
                        placeholder="Search users...">

                    <button
                        class="btn btn-primary"
                        type="submit">

                        Search

                    </button>

                </div>

            </form>

        </div>

        <!-- Error displays -->

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

        <div class="table-card">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Full Name</th>

                            <th>Email</th>

                            <th>Role</th>

                            <th>Verified</th>

                            <th>Joined</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($users)) : ?>

                            <?php foreach ($users as $user) : ?>

                                <tr>

                                    <td>
                                        <?= $user->id ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($user->fullname) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($user->email) ?>
                                    </td>

                                    <td>

                                        <?php if ($user->role === 'admin') : ?>

                                            <span class="badge bg-danger">
                                                Admin
                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-primary">
                                                User
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>

                                        <?php if ($user->email_verified) : ?>

                                            <span class="badge bg-success">
                                                Verified
                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>
                                        <?= htmlspecialchars($user->created_at) ?>
                                    </td>

                                    <td>

                                        <?php if ($user->role === 'admin') : ?>

                                            <a
                                                href="?demote=<?= $user->id ?>"
                                                class="btn btn-sm btn-outline-warning">

                                                Demote

                                            </a>

                                        <?php else : ?>

                                            <a
                                                href="?promote=<?= $user->id ?>"
                                                class="btn btn-sm btn-outline-primary">

                                                Promote

                                            </a>

                                        <?php endif; ?>
                                        <a
                                            href="?delete=<?= $user->id ?>"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this user permanently?' )">

                                            Delete

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="7" class="text-center">

                                    No users found.

                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>