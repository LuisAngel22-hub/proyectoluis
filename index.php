<?php
$alert = "";
session_start();
if (!empty($_SESSION['activa'])) {
    header('location: Cliente/inicio.php');
    exit;
} else {
    if (!empty($_POST)) {
        // Valida que correo y contraseña no estén vacíos
        if (empty($_POST['correo']) || empty($_POST['contra'])) {
            $alert = '<div class="alert alert-warning d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>
                            Correo y/o contraseña son obligatorios.
                        </div>
                    </div>';
        } else { // Cuando se ingresan datos
            require_once('Servidor/conexion.php');
            $usuario = mysqli_real_escape_string($conexion, $_POST['correo']);
            $pass = mysqli_real_escape_string($conexion, $_POST['contra']);
            $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$usuario' AND contra='$pass'");
            $resultado = mysqli_num_rows($query);



            if ($resultado > 0) {
                $dato = mysqli_fetch_array($query);
                // Creamos variables de tipo sesión para tener los datos disponibles
                $_SESSION['activa'] = true;
                $_SESSION['nombre'] = $dato['nomusu'];
                $_SESSION['paterno'] = $dato['apausu'];
                $_SESSION['materno'] = $dato['amausu'];
                $_SESSION['rol'] = $dato['idtipo'];
                mysqli_close($conexion);
                header('location: Cliente/inicio.php');
                exit;
            } else {
                $alert = '<div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                Usuario y/o contraseña incorrecta.
                            </div>
                          </div>';
                session_destroy();
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inicio de Autentificación</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <div class="container" style="padding-top: 23px;">
        <div class="row" style="background-color: green; text-align:center;">
            <div class="col" style="background-color: rgb(196,153,108);">
                <img src="Cliente/img/pepeSportt.png" height="350px" width="350px" style="padding-top: 55px;">
            </div>
            <div class="col" style="background-color: rgb(229,221,202);">
                <div class="row">
                    <h1 style="color: rgb(54,16,28); text-align:center; padding-top:20px">AUTENTICACIÓN</h1>
                </div>

                <form style="padding: 45px; text-align:left;" method="POST">
                    <div>
                        <?php echo isset($alert) ? $alert : ""; ?>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" aria-describedby="emailHelp" placeholder="Correo electronico">
                        <div id="emailHelp" class="form-text">No compartiremos tu correo con nadie.</div>
                    </div>
                    <div class="mb-3">
                        <label for="contra" class="form-label" >Contraseña</label>
                        <input type="password" class="form-control" id="contra" name="contra" placeholder="Contraseña">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Mantener sesión activa</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: rgb(54,16,28);">Enviar</button>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
