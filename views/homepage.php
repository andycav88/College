<script>
    document.title = "College Homepage";
</script>
<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include $root . "/college/includes/header.php"
?>

<body class="sb-nav-fixed">
    <?php include $root . "/college/includes/topnavbar.php" ?>
    <?php include $root . "/college/includes/sidenavbar.php" ?>
    <div class="d-flex bd-highlight" id="layoutSidenav_content">
        <main>
            <div class="container shadow min-vh-100 py-2">
                <div class="table-responsive">
                    <table class="table table-hover accordion">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Heading 1</th>
                                <th scope="col">Heading 2</th>
                                <th scope="col">Heading 3</th>
                                <th scope="col">Heading 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--style="background:#D3D3D3" ----- class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" -->

                            <tr class="collapsed" data-bs-toggle="collapse" data-bs-target="#r1">
                                <th scope="row">1 <i class="bi bi-chevron-down"></i></th>
                                <td>Cell1</td>
                                <td>Cell1</td>
                                <td>Cell1</td>
                                <td>Cell1</td>
                            </tr>

                            <tr class="collapse accordion-collapse" id="r1" data-bs-parent=".table">
                                <td colspan="5">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Subheading</div>
                                                Content for list item
                                            </div>
                                            <span class="badge bg-primary rounded-pill">14</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Subheading</div>
                                                Content for list item
                                            </div>
                                            <span class="badge bg-primary rounded-pill">Classroom B15</span>
                                            <span class="badge bg-primary rounded-pill">level 4</span>
                                            <span class="badge bg-primary rounded-pill">2022-2023</span>

                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="ms-2 me-auto">
                                                <div class="fw-bold">Subheading</div>
                                                Content for list item
                                            </div>
                                            <span class="badge bg-primary rounded-pill">14</span>
                                        </li>
                                    </ol>
                                </td>
                            </tr>
                            <tr data-bs-toggle="collapse" data-bs-target="#r2">
                                <th scope="row">2 <i class="bi bi-chevron-down"></i></th>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="collapse accordion-collapse" id="r2" data-bs-parent=".table">
                                <td colspan="5"> Item 2 detail .. This is the first item's accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow. </td>
                            </tr>
                            <tr data-bs-toggle="collapse" data-bs-target="#r3">
                                <th scope="row">3 <i class="bi bi-chevron-down"></i></th>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                                <td>Cell</td>
                            </tr>
                            <tr class="collapse accordion-collapse" id="r3" data-bs-parent=".table">
                                <td colspan="5"> Item 3 detail .. This is the first item's accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow. </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>





        </main>

        <?php include $root . "/college/includes/footer.php" ?>
    </div>
    </div>

</body>
<!-- TOAST -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <!-- <img src="sb-nav-link-icon" class="rounded me-2" alt="..."> -->
            <strong class="me-auto">Bootstrap</strong>
            <small>11 mins ago</small>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <!-- Wellcome!!!&nbsp;<?php echo $_SESSION['name']  ?> -->
        </div>
    </div>
</div>
<script>
    // var toastTrigger = document.getElementById('liveToastBtn')

    // if (toastTrigger) {
    //     toastTrigger.addEventListener('click', function() {
    //         var toast = new bootstrap.Toast(toastLiveExample)

    //         toast.show()
    //     })
    // }
    $(function() {
        var toastLiveExample = document.getElementById('liveToast')
        var toast = new bootstrap.Toast(toastLiveExample)

        toast.show();
    });
</script>

</html>