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
                <div class="table table-responsive">
                    <table class="table table-hover accordion" id="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Specialist</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyID">

                        </tbody>
                    </table>
                </div>
                <div class="alert alert-danger text-center" role="alert" id="notFound" style="display:none">
                    No result found!
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center" id="paginatorID">
                    </ul>
                </nav>

            </div>
    </div>

    </main>


</body>
</div>
<?php include "includes/footer.php" ?>
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
    var classesP;




    /*  ------Paginador-------- */

    function initPaginator() {
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
                return;
            });
            cargaPagina(paginaActual);
        }
    }

    function cargaPagina(pagina) {
        var desde = pagina * itemsPorPagina;

        loadProfData(desde);

        let prevBtn = paginador.children().first();
        let nextBtn = paginador.children().last();

        pagina >= 1 ? prevBtn.removeClass('disabled') : prevBtn.addClass('disabled');

        pagina == (totalPaginas - 1) ? (
            nextBtn.addClass('disabled'),
            nextBtn.data('tabindex', "-1")
        ) : nextBtn.removeClass('disabled');

        paginaActual = pagina;
        paginador.children().removeClass("active");
        paginador.children().eq(pagina + 1).addClass("active");
    }

    function limpiarCampos() {
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

    //! Estoy aqui
    //! Estoy aqui//! Estoy aqui//! Estoy aqui




    function updateProfessor() {


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

    function deleteProfesor() {

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



    //!++++++++++++ Functions para llenar los datos de clase y level +++++++++++++++
    //!---------------------------------------------------------------------------
    function loadProfData(desde) {

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
                $('#tbodyID').children().remove();
                $.each(data, function() {
                    let tr = $(`<tr id="tr${this.id}" class="trparent" data-id="${this.id}" data-bs-toggle="collapse" data-bs-target="#r${this.id}">`);

                    tr.html(`<th scope="row">${this.id}</th>
                            <td>${this.name}</td>
                            <td>${this.lastname}</td>
                            <td>${this.email}</td>
                            <td>${this.specialist == 1 ? "YES" : "NO"}</td>`);

                    $('#tbodyID').append(tr);
                })

                loadClasses();

            }
        })
    };

    function loadClasses() {
        {
            var x = "";
            var trs = $('#tbodyID').children();

            for (let i = 0; i < trs.length; ++i) {
                let trid = trs[i].getAttribute("data-id");

                $.ajax({
                    type: "POST",
                    url: "http://localhost/college/class/searchbyprofid",
                    data: {
                        idProf: trid
                    },
                    success: function(returnData) {

                        createClassElement(JSON.parse(returnData), trid);
                    }
                });
            }
            return;
        }
    };

    function createClassElement(classData, trid) {
        // console.log('classData :>> ', classData);
        // debugger;

        let trC = $(`<tr id="r${trid}" class="collapse accordion-collapse" data-bs-parent=".table">`);
        let td = $('<td colspan="5">');
        let ol = $(`<ol class="list-group list-group-numbered olist" data-id="${trid}" id="ol${trid}">`);


        for (let index = 0; index < classData.length; index++) {
            let li = $('<li class="list-group-item d-flex justify-content-between align-items-start">');
            let div = $(` <div class="ms-2 me-auto" id=pill${trid}>`); //Aqui en este elemento es donde hay que  poner datos adicionales
            let divHeading = $('<div class="fw-bold">');
            div.appendTo(li)
            divHeading.html(classData[index].name)
            divHeading.appendTo(div);
            li.appendTo(ol);
            debugger;
            $.ajax({
                type: "POST",
                url: "http://localhost/college/level/getlevelid",
                data: {
                    id: classData[0].id_level
                },
                success: function(returnData) {
                    debugger;
                    result = JSON.parse(returnData);
                    debugger;
                    li.append($(`<span class="badge bg-primary rounded-pill">${result.level}</span>`));
                    li.append($(`<span class="badge bg-primary rounded-pill">${result.classroom}</span>`));
                    li.append($(`<span class="badge bg-primary rounded-pill">${result.course}</span>`));
                }
            });
        }
        ol.appendTo(td);
        trC.append(td);
        $(`#tr${trid}`).after(trC);
        // debugger;
    }



    //!++++++++++++++++++++++++ Events ++++++++++++++++++
    //!--------------------------------------------------

    //Buttons Actions
    $('#btnAdd').click(function() {
        $('#modalLabel').html("New Professor");
        idUpdate = "";
        limpiarCampos();
        myModal.show();
    });
    $("#btnUpdate").click(updateProfessor);
    $("#btnDelete").click(deleteProfesor);


    /*On Document Load*/
    $(function() {
        assignFilterByAlign(); // calling function Alignment od Filter by:
        initPaginator(); //initPaginator Method that return the total rows in student's table
    });

    /*------------------ On Scren Resize --------------------*/
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