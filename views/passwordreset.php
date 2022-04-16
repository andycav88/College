<?php $title = "Password Reset" ?>
<?php include "includes/header.php" ?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Reset</h3>
                                </div>
                                <div class="card-body" id="bodyPass">
                                    <div class="alert alert-danger text-center" role="alert" style="display: none">
                                        Passwords do not match.
                                    </div>
                                    <div class="small mb-3 text-muted">Please enter your new password.</div>
                                    <form>
                                        <!-- <div class="form-group">
                                            <label for="exampleInputEmail1">Your new password</label>
                                            <input type="password" class="form-control form-control-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Repeat password</label>
                                            <input type="password" class="form-control form-control-sm">
                                        </div> -->
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="newPass" />
                                            <label for="newPass">Your new password</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="newPass1" />
                                            <label for="newPass1">Repeat password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="index">Return to login</a>
                                            <a class="btn btn-primary" id="btnSetPass">Set Password</a>
                                        </div>

                                </div>
                            </div>
                        </div>

                        </form>
                    </div>
                    <div class="card-footer text-center py-3">
                        <div class="small"><a href="register">Need an account? Sign up!</a></div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
</body>
<!-- Modal -->
<div class="modal fade" id="modalPass" tabindex="-1" aria-labelledby="modalPassLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPassLabel">Password successfuly set.</h5>
                <button type="button" id=closeModal class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#btnSetPass').click(function() {

        var myModal = new bootstrap.Modal(document.getElementById('modalPass'));

        if ($("#newPass").val() == $("#newPass1").val() && $("#newPass").val() != "") {
            var key = "<?php echo $pList ?>";
            var pass = $('#newPass').val();
            $.ajax({
                type: "POST",
                url: `http://localhost/college/session/setpassword/${key}`,
                data: {
                    pass: pass
                },
                success: function(returnData) {
                    let result = JSON.parse(returnData);
                    if (result == "true") {
                        myModal.show();
                        $('#closeModal').click(function() {
                            window.location = "../../session/index";
                        });
                    } else {
                        $(".alert").html("Error setting password.");
                        $(".alert").css('display', 'block');
                    }
                }
            });
        } else {
            $(".alert").html("Passwords do not match.");
            $(".alert").css('display', 'block');
        }
    });
</script>

</html>