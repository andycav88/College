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
            <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>






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