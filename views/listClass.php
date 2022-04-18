<?php $title = "Dashboard - Caso de Estudio" ?>
<?php include "includes/header.php" ?>

<body class="sb-nav-fixed" onload="pagination('%',1,5);">
    <?php include "includes/topnavbar.php" ?>
    <?php include "includes/sidenavbar.php" ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container table-responsive">
                <form class="row g-3">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id='findname' onkeyup="pagination('%',1,'');" placeholder="Name" aria-label="Username">                    </div>
                    <div class="input-group  col-12">
                        <select class="form-select" id="select" onChange="pagination('%',1,'');">
                            <option selected>5</option>
                            <option>10</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="container table-responsive">
                <h1 class="text-center"> Class </h1>

                <button class="btn btn-success" id="btnAdd">Add +</button>
                <table class="table  table-striped" id='table'>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Professor</th>
                            <th>Level</th>


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
                <h5 class="modal-title" id="modalLabel">Add Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control imputFieldP" id="nameClass" placeholder="*" name='name'>
                    <label id='labelN'>Name</label>
                </div>
            </div>
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

    pagination = function(nameC, start, end) {
        
        if ($('#findname').val() != '' || $('#findname').val() != '%') {
            nameC = $('#findname').val();
        }
        else{

        }
        end = $('#select').val();

        $.ajax({

            type: "Post",
            url: "http://localhost/college/class/pagination",
            data: {
                start: start,
                end: end,
                nameC: nameC,
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
                                <td>${results[i].id_level}</td>
                                <td>${results[i].id_professor}</td>
                                <td><button class='btn btn-warning btnUpdate'>Update</button></td>
                                <td><button class='btn btn-danger btnDelete'>Delete</button></td>`;
                    //The .append() method inserts the specified content as the last child of each element in the jQuery collection 
                    document.getElementById("table").querySelector("tbody").append(tr);
                    $(".btnUpdate").click(updateClass);
                    $(".btnDelete").click(deleteClass);
                }
             
                numLink = Math.ceil(cant / end);
               
                var ul = document.createElement("ul");
                if (start > 1) {
                    ul.innerHTML = `<li class="page-item active">
              <a class="page-link" href="javascript:void(0)" onclick="pagination('${nameC}',${start-1},${end}) ">Previous</a>
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
                    } else {
                        ul.innerHTML += `<li class='page-item'><a class='page-link' href='javascript:void(0)' onclick="pagination('${nameC}',${i},${end})" >${i}</li>`;

                    }
                }

                if (start < (numLink - 1)) {
                    ul.innerHTML += `<li class="page-item active">
             <a class="page-link" href="javascript:void(0)" onclick="pagination('${nameC}',${start+1},${end})">Next</a></li>`;
                } else {
                    ul.innerHTML += `<li class="page-item disabled">
             <a class="page-link" href="javascript:void(0)" >Next</a></li>`;
                }
                document.getElementById("pagination").querySelector("nav").append(ul);

            }

        });


    };




    let limpiarCampos = function() {
        $('#nameClass').val("");
        $('#labelN').css('color', 'black');


    };



    //Add+ Button Action - Show Modal
    $('#btnAdd').click(function() {

        $('#modalLabel').html("New Class");
        idUpdate = "";
        limpiarCampos();

        myModal.show();
    });
      let updateClass = function() {

           //.dataset obtiene el valor de la etiqueta data-... del boton editar
           // idUpdate = event.target.parentNode.parentNode.dataset.id;
           idUpdate = event.target.parentNode.parentNode.dataset.id;
           $("#modalLabel").html("Update Class");
           limpiarCampos();

           //Abajo solo paso la url pq solo quiero buscar la tarea por el id
           //por default se ejecuta po el GET, no paso variables pq ya eso se configuro
           //en el router.php

           $.ajax({
               type: "Post",
               url: "http://localhost/college/class/search",
               data: {
                   id: idUpdate,
               },
               success: function(returnData) {
                   let results = JSON.parse(returnData);
                   alert(results.name);
                   alert(results.id);
                   $('#nameClass').val(results.name);

               }
           });
           myModal.show();
       };

       let deleteClass = function() {
           //.dataset obtiene el valor de la etiqueta data-... del boton editar
           idUpdate = event.target.parentNode.parentNode.dataset.id;
           //$("#modalLabel").html("Delete Professor");
           // limpiarCampos();
           //Abajo solo paso la url pq solo quiero buscar la tarea por el id
           //por default se ejecuta po el GET, no paso variables pq ya eso se configuro
           //en el router.php
           $.ajax({
               type: "Post",
               url: "http://localhost/college/class/delete",
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
            pagination('%',1,'');
       }
    //Save Button Action - Modal
    $('#btnSave').click(function() {
        let option = "";
        
        if ($('#nameClass').val() == "" || $('#nameClass').val() == null) {
            $('#labelN').css('color', 'red');
            $('#nameClass').val("");
            return

        }
        name = $('#nameClass').val();
        $.ajax({
            //La url del archivo php
            type: "POST",
            url: "http://localhost/college/class/create",
            data: {
                name: name,
                id: idUpdate
            },
            success: function(returnData) {

                let results = JSON.parse(returnData);

                if (idUpdate == "") {

                    let tr = document.createElement("tr");
                    tr.setAttribute('data-id', results.id);
                    tr.innerHTML = `<td>${results.id}</td>
                                        <td>${results.name}</td>
                                        <td>${results.id_level}</td>
                                        <td>${results.id_professor}</td>
                                        <td><button class='btn btn-warning btnUpdate'>Update</button></td>
                                        <td><button class='btn btn-danger btnDelete'>Delete</button></td>`;
                    //The .append() method inserts the specified content as the last child of each element in the jQuery collection 
                    document.getElementById("table").querySelector("tbody").append(tr);
                      $(".btnUpdate").click(updateClass);
                      $(".btnDelete").click(deleteClass);
                } else {
                    let col = $(`tr[data-id=${results.id}]`).find('td');
                    col[0].innerText = results.id;
                    col[1].innerText = results.name;
                    col[2].innerText = results.id_level;
                    col[3].innerText = results.id_professor;
                

                }

                myModal.hide();
               
            }
           
        })
        pagination('%', 1, ''); 
    });

    $(".btnUpdate").click(updateClass);
    $(".btnDelete").click(deleteClass);






</script>








</html>