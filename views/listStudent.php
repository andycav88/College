<script>
    document.title = "College - Student";
</script>
<?php include "includes/header.php" ?>


<body class="sb-nav-fixed">
    <?php include "includes/topnavbar.php" ?>
    <?php include "includes/sidenavbar.php" ?>
    <div id="layoutSidenav_content">
        <main>

            <div class="container table-responsive">
                <h1 class="mt-5 text-center"> Students </h1>
                <button class="btn btn-success" id="btnAdd">Add</button>
                <table class="table  table-striped" id='table'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center" id="paginatorID">
                        <!-- Aqui se crean los controles del paginado -->
                    </ul>
                </nav>
            </div>


        </main>

        <?php include "includes/footer.php" ?>
    </div>
    </div>

</body>
<div class="modal fade" id="ProfeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control imputFieldP" id="nameStudent" placeholder="*" name='name'>
                    <label id='labelN'>Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control imputFieldP" id="lastStudent" placeholder="*" name='lastname'>
                    <label id="labelL">Last Name</label>
                </div>
                <!-- <div class="form-floating mb-3">
                    <input type="text" class="form-control imputFieldP" id="levelStudent" placeholder="*" name='specialist'>
                    <label id="labelS">Level</label>
                </div> -->
                <div class="form-floating mb-3">
                    <input type="email" class="form-control imputFieldP" id="emailStudent" placeholder="*" name='email'>
                    <label id="labelE">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control imputFieldP" id="passStudent" placeholder="*" name='password'>
                    <label id="labelP">Password</label>
                </div>
            </div>
            <input type="hidden" id="identificador" value="">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-guardar" id="btnSave">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('ProfeModal'))
    let idUpdate = "";


    // console.log('object :>> ', textFields);
    let limpiarCampos = function() {
        $('#nameStudent').val("");
        $('#lastStudent').val("");
        $('#emailStudent').val("");
        $('#passStudent').val("");
        $('#labelN').css('color', 'black');
        $('#labelL').css('color', 'black');
        $('#labelE').css('color', 'black');
        $('#labelP').css('color', 'black');
    };


    let editStudent = function() {

        //.dataset obtiene el valor de la etiqueta data-... del boton editar
        // idUpdate = event.target.parentNode.parentNode.dataset.id;
        idUpdate = event.target.parentNode.parentNode.dataset.id;
        $("#modalLabel").html("Update Professor");
        limpiarCampos();
        //Abajo solo paso la url pq solo quiero buscar la tarea por el id
        //por default se ejecuta po el GET, no paso variables pq ya eso se configuro
        //en el router.php

        $.ajax({
            type: "Post",
            url: "http://localhost/college/student/find",
            data: {
                id: idUpdate
            },
            success: function(returnData) {
                let results = JSON.parse(returnData);
                $('#nameStudent').val(results.name);
                $('#lastStudent').val(results.lastname);
                $('#emailStudent').val(results.specialist);
                $('#passStudent').val(results.email);
            }
        });
        myModal.show();
    };

    let deleteProfesor = function() {
        //.dataset obtiene el valor de la etiqueta data-... del boton editar
        idUpdate = event.target.parentNode.parentNode.dataset.id;
        //$("#modalLabel").html("Delete Professor");
        // limpiarCampos();
        //Abajo solo paso la url pq solo quiero buscar la tarea por el id
        //por default se ejecuta po el GET, no paso variables pq ya eso se configuro
        //en el router.php
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
                    alert("You can't delete that Student");
                }
            }
        });
    };

    //Add+ Button Action - Show Modal
    $('#btnAdd').click(function() {

        $('#modalLabel').html("New Professor");
        idUpdate = "";
        limpiarCampos();
        myModal.show();
    });
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
                        $('#nameStudent').val("");
                        break;
                    case 1:
                        $('#labelL').css('color', 'red');
                        $('#lastStudent').val("");
                        break;
                    case 2:
                        $('#labelE').css('color', 'red');
                        $('#emailStudent').val("");
                        break;
                    case 3:
                        $('#labelP').css('color', 'red');
                        $('#passStudent').val("");
                        break;
                }
            }
        }
        if (option != "")
            return;

        name = $('#nameStudent').val();
        lastname = $('#lastStudent').val();
        //debugger;

        email = $('#emailStudent').val();
        password = $('#passStudent').val();
        debugger;
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
                //  console.log(returnData); 
                if (idUpdate == "") {
                    let tr = document.createElement("tr");
                    tr.setAttribute('data-id', results.id);
                    tr.innerHTML = `<td>${results.id}</td>
                                    <td>${results.name}</td>
                                    <td>${results.lastname}</td>
                                    <td>${results.email}</td>
                                    <td><button class='btn btn-warning btnUpdate'>Update</button></td>
                                    <td><button class='btn btn-danger btnDelete'>Delete</button></td>`;
                    //The .append() method inserts the specified content as the last child of each element in the jQuery collection 
                    document.getElementById("table").querySelector("tbody").append(tr);
                    $(".btnUpdate").click(editStudent);
                    $(".btnDelete").click(deleteProfesor);
                } else {
                    let col = $(`tr[data-id=${results.id}]`).find('td');
                    col[0].innerText = results.id;
                    col[1].innerText = results.name;
                    col[2].innerText = results.lastname;
                    col[3].innerText = results.email;
                    col[4].innerText = results.specialist;
                }
                myModal.hide();
            }
        })
    });

    $(".btnUpdate").click(editStudent);
    $(".btnDelete").click(deleteProfesor);

    /*  ------Paginador-------- */

    var paginador;
    var totalPaginas;
    var itemsPorPagina = 5;
    var numerosPorPagina = 10;
    var paginaActual = 1;
    var ultimaRango = numerosPorPagina;

    function creaPaginador(totalItems) {

        paginador = $("#paginatorID");
        totalPaginas = Math.ceil(totalItems / itemsPorPagina);

        $('<li class="page-item"><a class="page-link" href="#" >Previous</a>').appendTo(paginador);
        var pag = 0;
        while (totalPaginas > pag) {
            $(`<li class="page-item pageNum"><a class="page-link" href="#">${pag+1}</a></li>`).appendTo(paginador);
            pag++;
        };

        if (numerosPorPagina > 1) {
            $(".pageNum").hide();
            $(".pageNum").slice(0, numerosPorPagina).show();
        };
        $('<li class="page-item"><a class="page-link" href="#">Next</a></li>').appendTo(paginador);


        //Event Prev Page
        paginador.children().first().click(function() {
            if (paginaActual >= 1) {
                cargaPagina(paginaActual - 1);
            }
        });
        //Event Next Page
        paginador.children().last().click(function() {

            if (paginaActual < totalPaginas - 1) {
                cargaPagina(paginaActual + 1);
            }
        });
        //Event Page Numbers
        $('.pageNum').click(function() {
            var irpagina = $(this).text() - 1;
            cargaPagina(irpagina);
        });

        cargaPagina(0);
    }

    function cargaPagina(pagina) {
        var desde = pagina * itemsPorPagina;

        $.ajax({
            type: "POST",
            url: "http://localhost/college/student/pagstudent",
            data: {
                param1: "dame",
                limit: itemsPorPagina,
                offset: desde
            },
            success: function(returnData) {

                var data = JSON.parse(returnData);
                $('tbody').children().remove();
                $.each(data, function() {

                    let tr = document.createElement("tr");
                    tr.setAttribute('data-id', this.id);
                    tr.innerHTML = `<td>${this.id}</td>
                        <td>${this.name}</td>
                        <td>${this.lastname}</td>
                        <td>${this.email}</td>
                        <td><button class='btn btn-warning btnUpdate'>Update</button></td>
                        <td><button class='btn btn-danger btnDelete'>Delete</button></td>`;
                    //The .append() method inserts the specified content as the last child of each element in the jQuery collection 
                    document.getElementById("table").querySelector("tbody").append(tr);
                    $(".btnUpdate").click(editStudent);
                    $(".btnDelete").click(deleteProfesor);
                })
            }
        });
        if (pagina >= 1) {
            paginador.children().first().removeClass('disabled');

        } else {
            paginador.children().first().addClass('disabled');
        }
        debugger;
        if (pagina == (totalPaginas - 1)) {

            paginador.children().last().addClass('disabled');
            paginador.children().last().data('tabindex', "-1");
        } else {

            paginador.children().last().removeClass('disabled');
        }

        paginaActual = pagina;

        if (totalPaginas > 1) {
            if ((ultimaRango - paginaActual) <= 1) {
                let b = ultimaRango + 2;
                let a = b - numerosPorPagina;
                $(".pageNum").hide();
                $(".pageNum").slice(a, b).show();
                ultimaRango = b;
            } else {
                if ((ultimaRango - paginaActual == numerosPorPagina) && ultimaRango > numerosPorPagina) {
                    let b = ultimaRango - 2;
                    let a = b - numerosPorPagina;
                    debugger;
                    $(".pageNum").hide();
                    $(".pageNum").slice(a, b).show();
                    ultimaRango = b;
                }
            }

        }

        paginador.children().removeClass("active");
        paginador.children().eq(pagina + 1).addClass("active");




    }


    $(function() {

        $.ajax({
            type: "POST",
            url: "http://localhost/college/student/pagstudent",
            data: {
                param1: "cuantos"
            },
            success: function(returnData) {


                let result = JSON.parse(returnData);
                console.log('Total Rows :>> ', result['total']);
                creaPaginador(result['total']);
            }
        });

    });
</script>






</html>