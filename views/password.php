<script>
    document.title = "Password Reset";
</script>
<?php
include "includes/header.php";
?>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                </div>
                                <div class="card-body" id="bodyPass">
                                    <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                    <form>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="index">Return to login</a>
                                            <a class="btn btn-primary" id="btnReset">Reset Password</a>
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
<script>
    $('#btnReset').click(function() {

        let alertMsg = function(msg, pClass) {

            let divAlert = document.getElementById("msgShow");

            if (divAlert) {
                divAlert.remove(); //Eliminamos el mensaje antes de volver a crear uno. Para evitar que se creen varios al oprimir el boton
                debugger;
            }
            //con este codigo se puede crear cualquier elemento y ubicarlo dentro de cualquier elemento existente.
            //en este caso dentro de un DIV que cree en el lugar donde queria que se mostrara el alert y le puse un id
            //para poder obtenerlo.
            divAlert = document.createElement("div");
            divAlert.setAttribute('id', "msgShow");
            divAlert.setAttribute('class', pClass);
            divAlert.setAttribute('role', "alert");
            divAlert.innerHTML = msg;
            document.getElementById("bodyPass").prepend(divAlert); //Insert as first child, (append -> insert as last child)
            $('#msgShow').fadeOut();
            $('#msgShow').fadeIn('slow');
        }

        let email = $('#inputEmail').val();
        if (email == "") {
            alertMsg("Invalid email.", "alert alert-danger text-center");
            return;
        } else {

            $.ajax({
                type: "POST",
                url: "http://localhost/college/session/passrecovery",
                data: {
                    email: email
                },
                success: function(returnData) {
                    let result = JSON.parse(returnData);
                    if (result == "true") {
                        alertMsg(`Recovery link sent to: ${email}.`, "alert alert-success alert-dismissable text-center");
                    } else {
                        alertMsg("Email not found.", "alert alert-danger alert-dismissable text-center");
                    }
                }
            });
        }
    });
</script>

</html>