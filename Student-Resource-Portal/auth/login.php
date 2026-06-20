<?php require_once '../includes/header.php'; ?>
<?php require_once '../includes/navbar.php'; ?>
<?php require_once '../classes/Database.php' ?>
<?php require_once '../classes/User.php' ?>

<?php
session_start();

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        $db = new Database();

        $conn = $db->conn();

        $user = new User($conn);

        $loggedIn = $user->login($email, $password);

        $_SESSION['user_id'] = $loggedIn->id;
        $_SESSION['role'] = $loggedIn->role;

        if ($loggedIn->role === 'admin') {
            header("Location: ../admin/dashboard.php");
            exit();
        } else {
            header("Location: ../dashboard/index.php");
        }
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
                            <i class="fas fa-right-to-bracket"></i>
                        </div>

                        <h2>Welcome Back</h2>

                        <p class="text-muted">
                            Login to access your resources.
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

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

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
                                    placeholder="Enter your password">

                            </div>

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember_me"
                                    id="rememberMe">

                                <label
                                    class="form-check-label"
                                    for="rememberMe">

                                    Remember Me

                                </label>

                            </div>

                            <a href="#" class="small">
                                Forgot Password?
                            </a>

                        </div>

                        <button
                            name="submit"
                            type="submit"
                            class="btn btn-primary w-100">

                            <i class="fas fa-right-to-bracket me-2"></i>
                            Login

                        </button>

                    </form>

                    <hr>

                    <div class="text-center">

                        <p class="mb-0">

                            Don't have an account?

                            <a href="register.php">
                                Register
                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<?php require_once '../includes/footer.php'; ?>