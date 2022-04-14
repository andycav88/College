    <!-- Panel Lateral  -->

    <?php echo "Hola" ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Aqui verificamos si el que esta logueado es el Admin y mostramos botones -->
                        <?php if ($_SESSION["user"] == "admin") { ?>
                            <div class="sb-sidenav-menu-heading">Manage</div>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-person-chalkboard"></i></div>
                                Professors
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                                Students
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard"></i></i></div>
                                Class
                            </a>
                            <a class="nav-link" href="">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-layer-group"></i></div>
                                Level
                            </a>
                        <?php } ?>
                        <div class="sb-sidenav-menu-heading">Professors</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.php">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.php">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.php">Login</a>
                                        <a class="nav-link" href="register.php">Register</a>
                                        <a class="nav-link" href="password.php">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.php">401 Page</a>
                                        <a class="nav-link" href="404.php">404 Page</a>
                                        <a class="nav-link" href="500.php">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Students</div>
                        <a class="nav-link" href="views/charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <?php echo $_SESSION["name"] ?></div>
                </div>
            </nav>
        </div>