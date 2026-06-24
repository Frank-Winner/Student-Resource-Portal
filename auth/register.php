<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/navbar.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php require_once '../classes/Database.php' ?>
<?php require_once '../classes/User.php' ?>

<?php
if (isset($_POST['submit'])) {

    validateCsrfToken(
        $_POST['csrf_token']
    );

    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    try {
        $db = new Database();

        $conn = $db->conn();

        $user = new User($conn);

        $user->register($fullname, $email, $password, $confirm_password);

        $success = "Account created successfully. Check your email and verify your account.";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<section class="auth-section py-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-8">

                <div class="auth-card">

                    <div class="text-center mb-4">

                        <div class="auth-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>

                        <h2>Create Account</h2>

                        <p class="text-muted">
                            Register to start managing your resources.
                        </p>

                    </div>

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

                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">

                        <input
                            type="hidden"
                            name="csrf_token"
                            value="<?= generateCsrfToken(); ?>">

                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fas fa-user"></i>
                                </span>

                                <input
                                    type="text"
                                    name="fullname"
                                    class="form-control"
                                    placeholder="Enter your full name">

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Email Address
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter your email">

                            </div>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Create password">

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fas fa-shield-halved"></i>
                                </span>

                                <input
                                    type="password"
                                    name="confirm_password"
                                    class="form-control"
                                    placeholder="Confirm password">

                            </div>

                        </div>

                        <button
                            name="submit"
                            type="submit"
                            class="btn btn-primary w-100">

                            <i class="fas fa-user-plus me-2"></i>
                            Create Account

                        </button>

                    </form>

                    <hr>

                    <div class="text-center">

                        <p class="mb-0">

                            Already have an account?

                            <a href="login.php">
                                Login
                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php require_once '../includes/footer.php'; ?>