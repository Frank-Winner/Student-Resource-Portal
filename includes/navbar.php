<?php require_once 'helpers.php'; ?>


<nav class="navbar navbar-expand-lg custom-navbar sticky-top">
    <div class="container">

        <a class="navbar-brand logo" href="/student-resource-portal">
            <i class="fas fa-graduation-cap me-2"></i>
            SRP
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarMenu">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a href="/student-resource-portal/" class="nav-link <?= isActive('/student-resource-portal/') ?>">
                        Home
                    </a>
                </li>

                <li class="nav-item ms-lg-2">
                    <a href="/student-resource-portal/auth/login.php"
                        class="btn btn-outline-primary nav-link <?= isActive('/student-resource-portal/auth/login.php') ?>">
                        Login
                    </a>
                </li>

                <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                    <a href="/student-resource-portal/auth/register.php"
                        class="btn btn-primary  nav-link <?= isActive('/student-resource-portal/auth/register.php') ?>">
                        Register
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>