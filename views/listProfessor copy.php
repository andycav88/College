<?php include "includes/header.php" ?>

<body class="sb-nav-fixed">
    <?php include "includes/topnavbar.php" ?>
    <?php include "includes/sidenavbar.php" ?>
    <div class="d-flex" id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="row">
                    <h1 class="text-center">Professor</h1>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="btn-group btn-group-sm " role="group">
                            <button type="button" class="btn mx-1 btn-success" id="btnAdd">Add</button>
                            <button type="button" class="btn mx-1 btn-warning" id="btnUpdate">Modify</button>
                            <button type=" button" class="btn mx-1 btn-danger" id="btnDelete" disabled>Delete</button>
                        </div>
                    </div>
                    <div class=" col-md-8">
                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-end mb-0" id="filterBy">Filter by:</p>
                            </div>
                            <div class="col-md-3 mb-1">
                                <input name="textinput" type="text" placeholder="Name" class="form-control form-control-sm" id="nameP" onkeyup="initPaginator();" />
                            </div>
                            <div class="col-md-3 mb-1">
                                <input name="textinput" type="text" placeholder="Last Name" class="form-control form-control-sm" id="lastP" onkeyup="initPaginator();" />
                            </div>
                            <div class="col-md-3 mb-1">
                                <input name="textinput" type="text" placeholder="Email" class="form-control form-control-sm" id="emailP" onkeyup="initPaginator();" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table">
                    <table class="table table-striped table-sm" id='table'>
                        <thead>
                            <tr>
                                <th><input class="form-check-input" type="checkbox" id="checkboxAll" value=""></th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Specialist</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--
                            <tr class="collapsed" data-bs-toggle="collapse" data-bs-target="#r1">
                                <th scope="row">1 <i class="bi bi-chevron-down"></i></th>
                                <td>Cell1</td>
                                <td>Cell1</td>
                                <td>Cell1</td>
                                <td>Cell1</td>
                            </tr>

                            <tr class="collapse accordion-collapse" id="r1" data-bs-parent=".table">
                                <td colspan="5">
                                    Item 1 detail .. This is the first item's accordion body. It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the .accordion-body, though the transition does limit overflow.
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
                            </tr> -->
                        </tbody>
                    </table>
                    <div class="alert alert-danger text-center" role="alert" style="display:none" id="notFound">
                        No results found!
                    </div>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center" id="paginatorID">
                        </ul>
                    </nav>

                </div>
            </div>
        </main>
        <?php include "includes/footer.php" ?>
    </div>
    </div>
</body>

<div class="modal fade" id="ProfeModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Crear Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control imputFieldP" id="nameProfe" placeholder="*" name='name'>
                    <label id='labelN'>Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control imputFieldP" id="lastProfe" placeholder="*" name='lastname'>
                    <label id="labelL">Last Name</label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input " type="checkbox" value="" id="speciaProfe1" name="radioProfeAll">
                    <label class="form-check-label " for="speciaProfe">
                        Specialist
                    </label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control imputFieldP" id="emailProfe" placeholder="*" name='email'>
                    <label id="labelE">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control imputFieldP" id="passProfe" placeholder="*" name='password'>
                    <label id="labelP">Password</label>
                </div>
            </div>
            <input type="hidden" id="identificador" value="">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-Save" id="btnSave">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- <script src="http://localhost/college/dist/js/simple-datatables.js"></script> -->


<script>
    var myModal = new bootstrap.Modal(document.getElementById('ProfeModal'))
    let idUpdate = "";

    var paginador;
    var totalPaginas;
    var itemsPorPagina = 14;
    var numerosPorPagina = 5;
    var paginaActual = 0;
    var ultimaRango = numerosPorPagina;
    var findByname;
    var findBylast;
    var findByemail;


    /*On Document Load*/
    $(function() {
        assignFilterByAlign(); // calling function Alignment od Filter by:
        initPaginator();
        //initPaginator Method that return the total rows in student's table

    });


    /*  ------Paginador-------- */

    let initPaginator = function() {


        findByname = $('#nameP').val() != '' ? $('#nameP').val() : '%';
        findBylast = $('#lastP').val() != '' ? $('#lastP').val() : '%';
        findByemail = $('#emailP').val() != '' ? $('#emailP').val() : '%';

        $.ajax({
            type: "POST",
            url: "http://localhost/college/professor/pagprofessor",
            data: {
                param1: "count",
                findByname: findByname,
                findBylast: findBylast,
                findByemail: findByemail,
            },
            success: function(returnData) {
                let result = JSON.parse(returnData);
                creaPaginador(result['total']);
            }
        });

    };


    function creaPaginador(totalItems) {

        $("#paginatorID").empty();
        if (totalItems == 0) {
            $('#notFound').show();
            $('tbody').empty();

        } else {
            $('#notFound').hide();

            paginador = $("#paginatorID");
            totalPaginas = Math.ceil(totalItems / itemsPorPagina);

            $('<li class="page-item"><a class="page-link">Previous</a>').appendTo(paginador);

            for (let index = 0; index < totalPaginas; index++) {
                $(`<li class="page-item pageNum"><a class="page-link">${index+1}</a></li>`).appendTo(paginador);
            }

            $('<li class="page-item"><a class="page-link">Next</a></li>').appendTo(paginador);

            if (numerosPorPagina > 1) {
                $(".pageNum").hide();
                $(".pageNum").slice(0, numerosPorPagina).show();
            };
            // Event Prev Page
            paginador.children().first().click(function() {
                if (paginaActual >= 1) {
                    cargaPagina(paginaActual - 1);
                    if (paginaActual == ultimaRango - numerosPorPagina - 1) {
                        let a = ultimaRango - numerosPorPagina - 1;
                        let b = a + numerosPorPagina;
                        $(".pageNum").hide();
                        $(".pageNum").slice(a, b).show();
                        ultimaRango = b;
                    }
                }
            });
            //Event Next Page
            paginador.children().last().click(function() {
                if (paginaActual < totalPaginas - 1) {
                    cargaPagina(paginaActual + 1);
                    if (paginaActual == ultimaRango) {
                        let a = ultimaRango - numerosPorPagina + 1;
                        let b = a + numerosPorPagina;
                        $(".pageNum").hide();
                        $(".pageNum").slice(a, b).show();
                        ultimaRango = b;
                    }
                }
            });
            //Event Page Numbers
            $('.pageNum').click(function() {
                var irpagina = $(this).text() - 1;
                cargaPagina(irpagina);
            });

            cargaPagina(paginaActual);
        }
    }

    function cargaPagina(pagina) {
        var desde = pagina * itemsPorPagina;
        $.ajax({
            type: "POST",
            url: "http://localhost/college/professor/pagprofessor",
            data: {
                param1: "dame",
                limit: itemsPorPagina,
                offset: desde,
                findByemail: findByemail,
                findByname: findByname,
                findBylast: findBylast,
            },
            success: function(returnData) {
                var data = JSON.parse(returnData);
                $('tbody').children().remove();
                $.each(data, function() {
                    let tr = document.createElement("tr");
                    tr.setAttribute('data-id', this.id);
                    tr.innerHTML = `<td><input class="form-check-input" type="checkbox" id="checkbox${this.id}" value="${this.id}" name="profCheckbox"> </td>
                                    <td>${this.id}</td>
                                    <td>${this.name}</td>
                                    <td>${this.lastname}</td>
                                    <td>${this.email}</td>
                                    <td>${this.specialist == 1 ? "YES" : "NO"}</td>`;
                    //The .append() method inserts the specified content as the last child of each element in the jQuery collection 
                    document.getElementById("table").querySelector("tbody").append(tr);
                })
            }
        });
        if (pagina >= 1) {
            paginador.children().first().removeClass('disabled');
        } else {
            paginador.children().first().addClass('disabled');
        }
        if (pagina == (totalPaginas - 1)) {
            paginador.children().last().addClass('disabled');
            paginador.children().last().data('tabindex', "-1");
        } else {
            paginador.children().last().removeClass('disabled');
        }
        paginaActual = pagina;
        paginador.children().removeClass("active");
        paginador.children().eq(pagina + 1).addClass("active");
    }

    let limpiarCampos = function() {
        $("#speciaProfe1").prop("checked", false);
        $('#nameProfe').val("");
        $('#lastProfe').val("");
        $('#emailProfe').val("");
        $('#passProfe').val("");
        $('#labelN').css('color', 'black');
        $('#labelL').css('color', 'black');
        $('#labelP').css('color', 'black');
        $('#labelS').css('color', 'black');
        $('#labelE').css('color', 'black');
    };



    //Add+ Button Action - Show Modal
    $('#btnAdd').click(function() {

        $('#modalLabel').html("New Professor");
        idUpdate = "";
        limpiarCampos();

        myModal.show();
    });

    let updateProfessor = function() {

        let checkedProfesor = $('input[name="profCheckbox"]:checked');

        if (checkedProfesor && checkedProfesor.length == 1) { //verificamos que este marcado y que solo halla marcado uno. 

            idUpdate = checkedProfesor.val();

            $("#modalLabel").html("Update Professor");
            limpiarCampos();

            //Abajo solo paso la url pq solo quiero buscar la tarea por el id
            //por default se ejecuta po el POST, no paso variables pq ya eso se configuro
            //en el router.php

            $.ajax({
                type: "Post",
                url: "http://localhost/college/professor/search",
                data: {
                    id: idUpdate,
                },
                success: function(returnData) {
                    let results = JSON.parse(returnData);
                    $('#nameProfe').val(results.name);
                    $('#lastProfe').val(results.lastname);
                    $('#emailProfe').val(results.email);
                    if (results.specialist == "1") {
                        $("#speciaProfe1").prop("checked", true);
                    } else {
                        $("#speciaProfe1").prop("checked", false);
                    }

                }
            });
            myModal.show();
        }
    };

    let deleteProfesor = function() {

        //.dataset obtiene el valor de la etiqueta data-... del boton editar
        idUpdate = event.target.parentNode.parentNode.dataset.id;
        $.ajax({
            type: "Post",
            url: "http://localhost/college/professor/delete",
            data: {
                id: idUpdate,
            },
            success: function(returnData) {
                let results = JSON.parse(returnData);
                console.log(results);
                if (results) {
                    $(`tr[data-id=${idUpdate}]`).remove();
                } else {
                    alert("You can't delete that Porfessor");
                }
            }
        });
        initPaginator();
    };
    //Save Button Action - Modal
    $('#btnSave').click(function() {
        let textFields = $('.imputFieldP'); //Aqui optengo todos los campos de entrada de datos para recorrerlos con el for
        let option = "";
        for (let i = 0; i < textFields.length; i++) {
            if (textFields[i].value == "" || textFields[i].value == null) {
                option = i;

                switch (option) {
                    case 0:
                        $('#labelN').css('color', 'red');
                        $('#nameProfe').val("");
                        break;
                    case 1:
                        $('#labelL').css('color', 'red');
                        $('#lastProfe').val("");
                        break;
                    case 2:
                        $('#labelE').css('color', 'red');
                        $('#emailProfe').val("");
                        break;
                    case 3:
                        $('#labelP').css('color', 'red');
                        $('#passProfe').val("");
                        break;
                }
            }
        }
        if (option != "")
            return;
        specialist = $("#speciaProfe1").is(':checked');
        name = $('#nameProfe').val();
        lastname = $('#lastProfe').val();
        email = $('#emailProfe').val();
        password = $('#passProfe').val();
        //debugger;
        $.ajax({
            //La url del archivo php
            type: "POST",
            url: "http://localhost/college/professor/create",
            data: {
                name: name,
                lastname: lastname,
                password: password,
                specialist: specialist,
                email: email,
                id: idUpdate
            },
            success: function(returnData) {

                let results = JSON.parse(returnData);
                specialist = results.specialist;
                if (specialist == 'true') {
                    specialist = 'Yes';
                } else {
                    specialist = 'No';
                }
                if (idUpdate == "") {
                    // ! Poner mensaje de Update Successful
                    alert("Modificado Ok");
                } else {
                    let col = $(`tr[data-id=${results.id}]`).find('td');
                    col[0].innerText = results.id;
                    col[1].innerText = results.name;
                    col[2].innerText = results.lastname;
                    col[3].innerText = results.email;
                    col[4].innerText = specialist;

                }

                myModal.hide();
            }
        })
        initPaginator();
    });

    $("#btnUpdate").click(updateProfessor);
    $("#btnDelete").click(deleteProfesor);



    /*------------------ On Scren Risize --------------------*/
    /*----------------------------------- --------------------*/

    window.addEventListener('resize', () => {
        assignFilterByAlign(); // calling function on resize
    });

    function assignFilterByAlign() {
        if ($(window).width() < 768) {
            /* checking for bootstrap MD breakpoint */
            $('#filterBy').removeClass('text-end').addClass('text-start');
        } else {
            $('#filterBy').removeClass('text-start').addClass('text-end');
        }
    }
</script>

</html>