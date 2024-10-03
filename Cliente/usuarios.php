<?php
include_once("../Servidor/conexion.php");
if (!empty($_POST)) {
  if (empty($_POST['cam1']) || empty($_POST['cam2']) || empty($_POST['cam3']) || empty($_POST['cam4']) || empty($_POST['cam5']) || empty($_POST['cam6']) || empty($_POST['cam7'])) {
    $alert = '<div class="alert alert-primary" role="alert">Todos los datos son obligatorios</div>';
  } else {
    $c1 = $_POST['cam1'];
    $c2 = $_POST['cam2'];
    $c3 = $_POST['cam3'];
    $c4 = $_POST['cam4'];
    $c5 = $_POST['cam5'];
    $c6 = $_POST['cam6'];
    $c7 = $_POST['cam7'];
    // $c8 = md5($_POST['cam5']); // Contraseña encriptada

    $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$c4'");
    $result = mysqli_fetch_array($query);

    if ($result > 0) {
      $alert = '<div class="alert alert-danger" role="alert">El correo y/o usuario ya existe</div>';
    } else {
      $consulta = mysqli_query($conexion, "INSERT INTO usuarios (nomusu, apausu, amausu, correo, contra, telefono, idtipo) 
            VALUES ('$c1', '$c2', '$c3','$c4', '$c5', $c6, '$c7')");

      if ($consulta) {
        $alert = '<div class="alert alert-success" role="alert">Datos guardados correctamente</div>';
      } else {
        $alert = '<div class="alert alert-danger" role="alert">Datos guardados incorrectamente</div>';
      }
    }
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Registro de Usuarios</title>
</head>

<body>
  <!--ENCABEZADO-->
  <header>
    <?php
    include_once("include/encabezado.php"); ?>
  </header>



  <!--FIN ENCABEZADO-->

  <div class="container" style="text-align: center;">

    <h2>ADMINISTRACIÓN DE USUARIOS</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Agregar Nuevo Usuario
    </button>


    <!-- On tables -->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido Paterno</th>
          <th scope="col">Apellido Materno</th>
          <th scope="col">Correo</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Tipo de Usuario</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <!--Nos quedamos con un solo tr y un solo td-->
      <tbody>

        <?php

        include_once("../Servidor/conexion.php");
        $con = mysqli_query($conexion, "SELECT u.idusu,u.nomusu,u.apausu,u.amausu,u.correo,u.telefono,t.tipousu FROM
usuarios u INNER JOIN tipousuarios t ON u.idtipo=t.idtipo");
        $res = mysqli_num_rows($con);
        while ($datos = mysqli_fetch_assoc($con)) {

          //para cada fila que se encuentra que duplica el td para que se pueda adaptar la tabla

        ?>
          <tr>
            <td> <?php echo $datos['nomusu']; ?> </td>
            <td> <?php echo $datos['apausu']; ?> </td>
            <td> <?php echo $datos['amausu']; ?> </td>
            <td> <?php echo $datos['correo']; ?> </td>
            <td> <?php echo $datos['telefono']; ?> </td>
            <td> <?php echo $datos['tipousu']; ?> </td>
            <!--Yo descargue las imagenes, pero se puede hacer poniendo una parte de codigo del faticon-->
            <!--Lo descargue en 32px-->

        <!--Boton de editar-->
            <?php if ($_SESSION['rol'] == 1) { ?>
              <td> <a href="../Servidor/editar_usuario.php?id=<?php echo $datos['idusu'];  ?>">
                  <button type="button" class="btn btn-info"><img src="img/refresh.png" alt="Recargar">


                  </button> </a>
              </td>
            <!--Boton de borrar-->
              <td> <a href="../Servidor/borrar_usuario.php?id=<?php echo $datos['idusu']; ?>"> <button type="button" class="btn btn-danger"><img src="img/delete.png" alt="Eliminar">
                  </button>
                </a>
              </td>
            <?php
            } ?>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de un nuevo usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <!--Esto lo añadi yo-->
        </div>
        <div class="modal-body">

          <!--Se agrega el forms que esta en el index-->
          <form style="padding: 45px; text-align:left;" method="POST">
            <div>
              <?php echo isset($alert) ? $alert : ""; ?>
            </div>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre(s)</label>
              <input type="text" class="form-control"  aria-describedby="emailHelp" placeholder="---Nombre---" id="cam1" name="cam1">

            </div>

            <div class="mb-3">
              <label for="apausu" class="form-label">Apellido Paterno</label>
              <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="---Primer Apellido---" id="cam2" name="cam2">

            </div>

            <div class="mb-3">
              <label for="nombre" class="form-label">Apellido Materno</label>
              <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Segundo Apellido" id="cam3" name="cam3">

            </div>


            <!--Lista desplegable-->
            <div class="mb-3">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Correo electronico" id="cam4" name="cam4">
              <div id="emailHelp" class="form-text">No compartiremos tu correo con nadie.</div>
            </div>
            <div class="mb-3">
              <label for="contra" class="form-label">Contraseña</label>
              <input type="password" class="form-control" placeholder="Contraseña" id="cam5" name="cam5">
            </div>
            <div class="mb-3">
              <label for="nombre" class="form-label">Teléfono</label>
              <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Numero Celular" id="cam6" name="cam6">

            </div>

            <select class="form-select" aria-label="Default select example" id="cam7" name="cam7">
              <option selected>Seleccionar Privilegios</option>
              <?php
              include_once("../servidor/conexion.php");
              $cone = mysqli_query($conexion, "SELECT * FROM tipousuarios ORDER BY tipousuarios.tipousu ASC");
              $resu = mysqli_num_rows($cone);
              while ($dat = mysqli_fetch_assoc($cone)) {
              ?>

                <option value="<?php echo $dat['idtipo'] ?>"><?php echo $dat['tipousu'] ?></option>

              <?php
              }
              ?>
            </select>
            <!---->
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              
              <button type="submit" class="btn btn-primary">Guardar Información</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <!--Pie de pagina-->
  <footer>
    <?php
    include_once("include/pie.php"); ?>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>