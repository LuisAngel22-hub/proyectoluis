<?php 
//Para que se cierre la sesion en un lapso de inactividad
    session_start();
    if (!isset($_SESSION['tiempo'])) {
        $_SESSION['tiempo']=time();
    }
    else if (time() - $_SESSION['tiempo'] > 200) {
        
        session_destroy();
        header('location:../');
        die();  
    }
    $_SESSION['tiempo']=time();
?>
<!--Inicia Sesion-->

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container" style="text-align: center; padding-top: 15px; background-color:lightgreen">
        <div class="row">
            <div class="col-3">
                <img src="img/pepeSportt.png" width="100px" height="100px" style="padding-top: 20px;">
            </div>
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic outlined example" style="padding: 20px;">
<!-- Esta es la parte que va a ver el administrador, solo las tablas ya que el es el privilegio 1-->

                 <?php if ($_SESSION['rol'] == 1){ ?>
                    <a href="inicio.php"><button type="button" class="btn btn-outline-primary">Inicio</button></a>
                    <a href="usuarios.php"><button type="button" class="btn btn-outline-primary">Usuarios</button></a>
                    <a href="categorias.php"><button type="button" class="btn btn-outline-primary">Categorias</button></a>
                    <a href="productos.php"><button type="button" class="btn btn-outline-primary">Productos</button></a>
                    <a href="promociones"><button type="button" class="btn btn-outline-primary">Promociones</button></a>
                    <a href="reportes.php"><button type="button" class="btn btn-outline-primary">Reportes</button></a>
                    <a href="salir.php"><button type="button" class="btn btn-outline-primary">Salir</button></a>
                    <?php  
                  } ?>


                    <?php if ($_SESSION['rol'] == 2) {?>
                    <a href="inicio.php"><button type="button" class="btn btn-outline-primary">Inicio</button></a>
                    <a href="categorias.php"><button type="button" class="btn btn-outline-primary">Categorias</button></a>
                    <a href="productos.php"><button type="button" class="btn btn-outline-primary">Productos</button></a>
                    <a href="promociones"><button type="button" class="btn btn-outline-primary">Promociones</button></a>
                    <a href="salir.php"><button type="button" class="btn btn-outline-primary">Salir</button></a>
                    <?php     }?>

                    <?php if ($_SESSION['rol'] == 3){ ?>
                    <a href="inicio.php"><button type="button" class="btn btn-outline-primary">Inicio</button></a>
                    <a href="usuarios.php"><button type="button" class="btn btn-outline-primary">Usuarios</button></a>
                    <a href="categorias.php"><button type="button" class="btn btn-outline-primary">Categorias</button></a>
                    <a href="productos.php"><button type="button" class="btn btn-outline-primary">Productos</button></a>
                    <a href="salir.php"><button type="button" class="btn btn-outline-primary">Salir</button></a>
                    <?php  
                  } ?>


                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
