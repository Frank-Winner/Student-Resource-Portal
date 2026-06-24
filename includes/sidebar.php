<?php require_once 'helpers.php'; ?>

<div class="dashboard-sidebar" id="sidebar">

    <div class="sidebar-logo">
        <i class="fas fa-graduation-cap me-2"></i>
        SRP
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="index.php" class="nav-link <?= isActive('index.php') ?>">
                <i class="fas fa-house"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="resources.php" class="nav-link <?= isActive('resources.php') ?>">
                <i class="fas fa-folder-open"></i>
                My Resources
            </a>
        </li>

        <li>
            <a href="create-resource.php" class="nav-link <?= isActive('create-resource.php') ?>">
                <i class="fas fa-cloud-arrow-up"></i>
                Upload Resource
            </a>
        </li>

        <li>
            <a href="profile.php" class="nav-link <?= isActive('profile.php') ?>">
                <i class="fas fa-user"></i>
                Profile
            </a>
        </li>

        <li>
            <a href="change-password.php" class="nav-link <?= isActive('change-password.php') ?>">
                <i class="fas fa-key"></i>
                Change Password
            </a>
        </li>

        <li>
            <a href="../auth/logout.php">
                <i class="fas fa-right-from-bracket"></i>
                Logout
            </a>
        </li>

    </ul>

</div>