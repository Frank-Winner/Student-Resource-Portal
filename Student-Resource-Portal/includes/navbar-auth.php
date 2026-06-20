<nav class="navbar navbar-expand-lg custom-navbar sticky-top">

    <div class="container">

        <a class="navbar-brand logo" href="#">
            <i class="fas fa-graduation-cap me-2"></i>
            SRP
        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#authNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
            id="authNavbar">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">

                    <a href="../dashboard/index.php"
                        class="nav-link">

                        Dashboard

                    </a>

                </li>

                <li class="nav-item">

                    <a href="../dashboard/resources.php"
                        class="nav-link">

                        Resources

                    </a>

                </li>

                <li class="nav-item">

                    <a href="../dashboard/profile.php"
                        class="nav-link">

                        Profile

                    </a>

                </li>

                <li class="nav-item dropdown">

                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        data-bs-toggle="dropdown">

                        <i class="fas fa-user-circle me-1"></i>
                        Account

                    </a>

                    <ul class="dropdown-menu">

                        <li>

                            <a
                                class="dropdown-item"
                                href="../dashboard/change-password.php">

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