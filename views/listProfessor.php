<!DOCTYPE html>


<script>
    document.title = "College - Professor";
</script>
<?php include_once "includes/header.php" ?>

<!DOCTYPE html>

<body class="sb-nav-fixed" onload="pagination('%','%',1,5);">

    <?php include "includes/topnavbar.php" ?>
    <?php include "includes/sidenavbar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container table-responsive">
                  <form class="row g-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id='findname' onkeyup="pagination('%','%',1,'');"   placeholder="Username" aria-label="Username">
                        <span class="input-group-text">@</span>
                        <input type="text" class="form-control" id='findemail' placeholder="email" onkeyup="pagination('%','%',1,'');"  aria-label="Server">
                    </div>
                    <div class="input-group  col-12">
                        <select class="form-select" id="select" onChange="pagination('%','%',1,'')" >
                            <option selected>5</option>
                            <option>10</option>
                            <option>20</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="container table-responsive">
                <h1 class="text-center"> Professors </h1>
                <button class="btn btn-success" id="btnAdd">Add +</button>
                <table class="table  table-striped" id='table'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Specialist</th>

                        </tr>
                    </thead>
                    <tbody id="tbody">


                    </tbody>
                </table>
                <div id="pagination">
                    <nav aria-label="..." id="nav">

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
                    <input class="form-check-input " type="checkbox" value="" id="speciaProfe1" name="radioProfe">
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


<script>
    $(function() {
        var myModal = new bootstrap.Modal(document.getElementById('ProfeModal'))
        let idUpdate = "";


        // console.log('object :>> ', textFields);
        let limpiarCampos = function() {
            $('#nameProfe').val("");
            $('#lastProfe').val("");
            $('#speciaProfe').val("");
            $('#emailProfe').val("");
            $('#passProfe').val("");
            $('#labelN').css('color', 'black');
            $('#labelL').css('color', 'black');
            $('#labelP').css('color', 'black');
            $('#labelS').css('color', 'black');
            $('#labelE').css('color', 'black');
        };


        let editarTarea = function() {

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
                url: "http://localhost/college/professor/find",
                data: {
                    id: idUpdate
                },
                success: function(returnData) {
                    let results = JSON.parse(returnData);
                    $('#nameProfe').val(results.name);
                    $('#lastProfe').val(results.lastname);
                    $('#speciaProfe').val(results.specialist);
                    $('#emailProfe').val(results.email);


<script>
    var myModal = new bootstrap.Modal(document.getElementById('ProfeModal'))
    let idUpdate = "";

      pagination = function(nameP,emailP, start, end) {

    
        if ($('#findemail').val() != '' || emailP != '%') {
            emailP = $('#findemail').val();
        }

        if ($('#findname').val() != '' || nameP != '%') {
            nameP = $('#findname').val();
        }
        end = $('#select').val();

      
        
      
        $.ajax({

            type: "Post",
            url: "http://localhost/college/professor/pagination",
            data: {
                start: start,
                end: end,
                nameP: nameP,
                emailP: emailP
            },
            success: function(returnData) {

                $('#nav').empty();
                $('#tbody').empty();
                var arrayfix = returnData.split('*');
                var results = JSON.parse(arrayfix[0]);
                var cant = arrayfix[1];
                
               

                for (var i = 0; i < results.length; i++) {

                    let tr = document.createElement("tr");
                    tr.setAttribute('data-id', results[i].id);
                    tr.innerHTML = `<td>${results[i].id}</td>
                                <td>${results[i].name}</td>
                                <td>${results[i].lastname}</td>
                                <td>${results[i].email}</td>
                                <td>${results[i].specialist}</td>
                                <td><button class='btn btn-warning btnUpdate'>Update</button></td>
                                <td><button class='btn btn-danger btnDelete'>Delete</button></td>`;
                    //The .append() method inserts the specified content as the last child of each element in the jQuery collection 
                    document.getElementById("table").querySelector("tbody").append(tr);
                    $(".btnUpdate").click(editarTarea);
                    $(".btnDelete").click(deleteProfesor);
                }
              
                numLink = Math.ceil(cant / end);
  
                var ul = document.createElement("ul");
                if (start > 1) {
                    ul.innerHTML = `<li class="page-item active">
              <a class="page-link" href="javascript:void(0)" onclick="pagination('${nameP}','${emailP}',${start-1},${end}) ">Previous</a>
              </li>`;
                } else {
                    ul.innerHTML = `<li class="page-item disabled">
              <a class="page-link" href="javascript:void(0)" tabindex="-1" >Previous</a>
              </li>`;
                }


                ul.setAttribute('class', 'pagination');
                for (let i = 1; i <= numLink; i++) {
                    if (start == i) {
                        ul.innerHTML += `<li class='page-item active' id= "link"><a class='page-link' href='javascript:void(0)'>${i}</li>`;

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
                type: "POST",
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
                        ul.innerHTML += `<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick="pagination('${nameP}','${emailP}',${i},${end})" >${i}</li>`;

                    }
                }

                if (start < (numLink - 1)) {
                    ul.innerHTML += `<li class="page-item active">
             <a class="page-link" href="javascript:void(0)" onclick="pagination('${nameP}','${emailP}',${start+1},${end})">Next</a></li>`;
                } else {
                    ul.innerHTML += `<li class="page-item disabled">
             <a class="page-link" href="javascript:void(0)" >Next</a></li>`;
                }
                document.getElementById("pagination").querySelector("nav").append(ul);

            }

        });


    };




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
    let editarTarea = function() {

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
            url: "http://localhost/college/professor/search",
            data: {
                id: idUpdate,
            },
            success: function(returnData) {
                let results = JSON.parse(returnData);
                $('#nameProfe').val(results.name);
                $('#lastProfe').val(results.lastname);
                $('#emailProfe').val(results.email);
                if (results.specialist == "true") {
                    $("#speciaProfe1").prop("checked", true);
                } else {
                    $("#speciaProfe1").prop("checked", false);
                }

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
                    alert("You can't delete that Porfessor");
                }
            }
        });
        pagination('%','%',1,'');
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

                    let tr = document.createElement("tr");
                    tr.setAttribute('data-id', results.id);
                    tr.innerHTML = `<td>${results.id}</td>
                                        <td>${results.name}</td>
                                        <td>${results.lastname}</td>
                                        <td>${results.email}</td>
                                        <td>${specialist}</td>
                                        <td><button class='btn btn-warning btnUpdate'>Update</button></td>
                                        <td><button class='btn btn-danger btnDelete'>Delete</button></td>`;
                    //The .append() method inserts the specified content as the last child of each element in the jQuery collection 
                    document.getElementById("table").querySelector("tbody").append(tr);
                    $(".btnUpdate").click(editarTarea);
                    $(".btnDelete").click(deleteProfesor);
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
        pagination('%','%',1,'');
    });

    $(".btnUpdate").click(editarTarea);
    $(".btnDelete").click(deleteProfesor);
</script>








</html>