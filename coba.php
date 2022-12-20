<nav class="navbar navbar-expand-lg navbar-light sticky-top" id='navbar'>
    <!-- Container wrapper -->
    <div class="container-fluid" id='contain-dropdown' style="margin-top: 0px;background-color:transparent ">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-light"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0" href="#" style='background-color:transparent'>
                <img src="img\white.png" height="45" alt="GR Logo" loading="lazy" />
            </a>
            <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
            <div class="input-group d-flex justify-content-center">
                <div class="coba form-outline rounded border border-light" id="search-unit" style="--bs-border-opacity: .5;">
                    <form class="d-flex flex-row" action="search.php" method="GET">
                        <input id="search-input" type="search" name="search_index" class="form-control text-light" />
                        <button type="submit" id='myBtn' class="btn" name="submit_btn" style="background-color:transparent; line-height:2.3">
                            <i class="fas fa-search text-light"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Collapsible wrapper -->

        <!-- Right elements -->
        <?php if (isset($_SESSION["login_user"])) : ?>
            <div class="d-flex align-items-center">

                <!-- Avatar -->
                <div class="dropdown ">

                    <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="img/anonymous.jpg" class="rounded-circle" height="40" alt="Profile" loading="lazy" />
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" id="profile-down" aria-labelledby="navbarDropdownMenuAvatar">
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php else : ?>
            <div class="d-flex align-items-center">
                <a class="text-reset me-3" href="login2.php">
                    <button type="button" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark">Login</button>
                </a>
            </div>
        <?php endif; ?>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>