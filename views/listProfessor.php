<?php $title = "Dashboard - Caso de Estudio" ?>
<?php include "includes/header.php" ?>


<body class="sb-nav-fixed">
  <?php include "includes/topnavbar.php" ?>
  <?php include "includes/sidenavbar.php" ?>
  <div id="layoutSidenav_content">
    <main>

      <div class="container table-responsive">
        <h1 class="mt-5 text-center"> Lista de Profesores </h1>
        <button class="btn btn-success" id="btnAceptar">Agregar</button>
        <table class="table  table-striped" id='table'>
          <thead>
            <tr>
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
                <td><?php echo $fila->email; ?> </td>
                <td> <button data-id="<php echo $fila->id ?>" class='btn btn-warning btnEditar'>Editar</button></td>
                <td> <button data-id="<php echo $fila->id ?>" class='btn btn-danger btnEliminar'>Eliminar</button></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
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
        <h5 class="modal-title" id="exampleModalLabel">Crear Tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="nameProfe" placeholder="*" name='name'>
          <label id='labelN'>Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="lastProfe" placeholder="*" name='lastname'>
          <label id="labelL">Last Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="speciaProfe" placeholder="*" name='specialist'>
          <label id="labelS">Specialist</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="emailProfe" placeholder="*" name='email'>
          <label id="labelE">Email</label>
        </div>
        <div class="form-floating mb-3">
          <input type="password" class="form-control" id="passProfe" placeholder="*" name='password'>
          <label id="labelP">Password</label>
        </div>
      </div>
      <input type="hidden" id="identificador" value="">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btn-guardar" id="btnGuardar">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- <script src="http://localhost/college/dist/js/simple-datatables.js"></script> -->
<script>
  var myModal = new bootstrap.Modal(document.getElementById('ProfeModal'))

  $('#btnAceptar').click(function() {

    document.querySelector('#exampleModalLabel').innerHTML = "Insertar Datos del Profesor";
    document.querySelector("#identificador").value = "";
    myModal.show();


  });

  $('#btnGuardar').click(function() {
    var name = $('#nameProfe').val();
    var lastname = $('#lastProfe').val();
    var specialist = $('#speciaProfe').val();
    var email = $('#emailProfe').val();
    var password = $('#passProfe').val();
    var id = document.querySelector("#identificador").value;
    $('#labelN').css('color', 'black');
    $('#labelL').css('color', 'black');
    $('#labelP').css('color', 'black');
    $('#labelS').css('color', 'black');
    $('#labelE').css('color', 'black');
    /*   $('#nameProfe').val("");
       $('#lastProfe').val("");
       $('#speciaProfe').val("");
       $('#emailProfe').val(""); 
       $('#passProfe').val("");*/

    if ((name == "" || name == null)) {

      $('#labelN').css('color', 'red');
      $('#nameProfe').val("");
      return false;
    }
    if ((lastname == "" || lastname == null)) {

      $('#labelL').css('color', 'red');
      $('#lastProfe').val("");
      return false;
    }
    if ((password == "" || password == null)) {

      $('#labelP').css('color', 'red');
      $('#passProfe').val("");
      return false;
    }

    if ((email == "" || email == null)) {

      $('#labelE').css('color', 'red');
      $('#emailProfe').val("");
      return false;
    }

    if ((specialist == "" || specialist == null)) {

      $('#labelS').css('color', 'red');
      $('#speciaProfe').val("");
      return false;
    }


    $.ajax({
      //La url del archivo php

      type: "POST",
      url: `http://localhost/college/professor/${id=="" ? 'create' : 'update'}`,
      data: {
        name: name,
        lastname: lastname,
        id: id,
        password: password,
        specialist: specialist,
        email: email
      },
      success: function(returnData) {
        console.log(returnData);

        var results = JSON.parse(returnData);
        console.log(results);
        /*if(aux ==""){
         let tr = document.createElement("tr");
         tr.setAttribute('data-id',results.id);
           tr.innerHTML = `<td>${results.id}</td> 
                           <td>${results.nombre}</td>
                           <td>${results.vencimiento}</td>
                           <td><button data-id = "${results.id}" class='btn btn-warning btnEditar'>Editar</button></td>
                           <td><button class='btn btn-danger btnEliminar'>Eliminar</button></td>`;
           document.getElementById("table").querySelector("tbody").append(tr);
       
              }else{
              let tr = document.querySelector(`tr[data-id="${id}"]`);
              let cols = tr.querySelectorAll("td");
              cols[1].innerText = results.nombre;
              cols[2].innerText = results.vencimiento;
 




              }*/
        myModal.hide();
      }
    })





  });
</script>








</html>