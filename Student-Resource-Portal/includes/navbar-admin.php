<nav class="navbar navbar-expand-lg custom-navbar sticky-top">

    <div class="container">

        <a class="navbar-brand logo" href="#">
            <i class="fas fa-graduation-cap me-2"></i>
            SRP Admin
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#adminNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
            id="adminNavbar">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a href="/student-resource-portal/dashboard/index.php"
                        class="nav-link">

                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a href="/student-resource-portal/admin/users.php"
                        class="nav-link">

                        Users

                    </a>

                </li>

                <li class="nav-item">

                    <a href="/student-resource-portal/admin/resources.php"
                        class="nav-link">

                        Resources

                    </a>

                </li>

                <li class="nav-item dropdown">

                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        data-bs-toggle="dropdown">

                        <i class="fas fa-user-shield me-1"></i>
                        Admin

                    </a>

                    <ul class="dropdown-menu">

                        <li>

                            <a
                                class="dropdown-item"
                                href="/student-resource-portal/dashboard/change-password.php">

                                Change Password

                            </a>

                        </li>

                        <li>

                            <a
                                class="dropdown-item"
                                href="../auth/logout.php">

                                Logout

                            </a>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>