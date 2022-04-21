    <!-- Panel Lateral  -->

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <!-- Aqui verificamos si el que esta logueado es el Admin y mostramos botones -->
                        <?php switch ($_SESSION["user"]) {
                            case 'admin':
                                include_once "sideManage.php";
                                include_once "sideProfessor.php";
                                include_once "sideStudent.php";
                                break;
                            case 'student':
                                include_once "sideStudent.php";
                                break;
                            case 'professor':
                                include_once "sideProfessor.php";
                                include_once "sideStudent.php";
                                break;
                            default:
                                //code
                                break;
                        } ?>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as: <?php echo $_SESSION["name"] ?></div>
                </div>
            </nav>
        </div>