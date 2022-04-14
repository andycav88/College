<?php $title = "Dashboard - Caso de Estudio" ?>
<?php include "includes/header.php" ?>


<body class="sb-nav-fixed">
    <?php include "includes/topnavbar.php" ?>
    <?php include "includes/sidenavbar.php" ?>
    <div id="layoutSidenav_content">
        <main>

            <div class="container table-responsive">
                <h1 class="mt-5 text-center"> Professors </h1>
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
                    <tbody>
                        <?php foreach ($pList as $fila) : ?>
                            <tr data-id=<?php echo $fila->id; ?>>
                                <td><?php echo $fila->id; ?> </td>
                                <td><?php echo $fila->name; ?> </td>
                                <td><?php echo $fila->lastname; ?> </td>
                                <td><?php echo $fila->email; ?> </td>
                                <td><?php echo $fila->specialist; ?> </td>
                                <td> <button data-id="<?php echo $fila->id ?>" class='btn btn-warning btnUpdate'>Update</button></td>
                                <td> <button data-id="<?php echo $fila->id ?>" class='btn btn-danger btnDelete'>Delete</button></td>
                            </tr>
                        <?php endforeach;  ?>
                    </tbody>
                </table>
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
                <div class="form-floating mb-3">
                    <input type="text" class="form-control imputFieldP" id="speciaProfe" placeholder="*" name='specialist'>
                    <label id="labelS">Specialist</label>
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
                    id: idUpdate,
                },
                success: function(returnData) {
                    let results = JSON.parse(returnData);
                    $('#nameProfe').val(results.name);
                    $('#lastProfe').val(results.lastname);
                    $('#speciaProfe').val(results.specialist);
                    $('#emailProfe').val(results.email);

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
                            $('#nameProfe').val("");
                            break;
                        case 1:
                            $('#labelL').css('color', 'red');
                            $('#lastProfe').val("");
                            break;
                        case 2:
                            $('#labelS').css('color', 'red');
                            $('#especiaProfe').val("");
                            break;
                        case 3:
                            $('#labelE').css('color', 'red');
                            $('#emailProfe').val("");
                            break;
                        case 4:
                            $('#labelP').css('color', 'red');
                            $('#passProfe').val("");
                            break;
                    }
                }
            }
            if (option != "")
                return;

            name = $('#nameProfe').val();
            lastname = $('#lastProfe').val();
            //debugger;
            specialist = $('#speciaProfe').val();
            if (isNaN(specialist) == true || specialist < 1 || specialist > 2) {
                debugger;
                $('#labelS').css('color', 'red');
                alert("Especialidad no valida");
                return;
            }

            email = $('#emailProfe').val();
            password = $('#passProfe').val();
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
                        debugger;
                        let tr = document.createElement("tr");
                        tr.setAttribute('data-id', results.id);
                        tr.innerHTML = `<td>${results.id}</td>
                                        <td>${results.name}</td>
                                        <td>${results.lastname}</td>
                                        <td>${results.email}</td>
                                        <td>${results.specialist}</td>
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
                        col[4].innerText = results.specialist;

                    }

                    myModal.hide();
                }
            })
        });

        $(".btnUpdate").click(editarTarea);
        $(".btnDelete").click(deleteProfesor);
    })
</script>








</html>