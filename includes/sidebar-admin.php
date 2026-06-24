<?php require_once 'helpers.php'; ?>


<div class="dashboard-sidebar" id="sidebar">

    <div class="sidebar-logo">
        <i class="fas fa-user-shield me-2"></i>
        Admin Panel
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="dashboard.php" class="nav-link <?= isActive('dashboard.php') ?>">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="users.php" class="nav-link <?= isActive('users.php') ?>">
                <i class="fas fa-users"></i>
                Manage Users
            </a>
        </li>

        <li>
            <a href="resources.php" class="nav-link <?= isActive('resources.php') ?>">
                <i class="fas fa-folder-tree"></i>
                Manage Resources
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