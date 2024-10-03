<?php
include_once("../Servidor/conexion.php");
if (!empty($_POST)) {
    //para validar que los campos no esten vacios
    if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['cantidad']) || empty($_POST['precio']) || empty($_POST['color']) || empty($_POST['tamanio']) || empty($_POST['foto'])|| empty($_POST['idcat'])) {
        //alerta para decir que los valores 
        $alert = '<div class="alert alert-primary" role="alert"> 
    Todos los datos son obligatorios
     </div>';
    } else {

        $idproducto = $_GET['id'];
        $c1 = $_POST['nombre'];
        $c2 = $_POST['descripcion'];
        $c3 = $_POST['cantidad'];
        $c4 =  $_POST['precio'];
        $c5 = $_POST['color'];
        $c6 = $_POST['tamanio'];
        $c7 = $_POST['foto'];
        $c8 = $_POST['idcat'];
        

      
            $consulta = mysqli_query($conexion, "INSERT INTO productos(nombre, descripcion, cantidad, precio, color, tamanio, foto, idcat)
                                                       values('$c1', '$c2', '$c3', '$c4', '$c5', '$c6', '$c7', '$c8')");

            if ($consulta) {
                
                $alert = '<div class="alert alert" role="alert">
                  Datos guardados correctamente </div>';
                  
                    // **Redirección después de la inserción para evitar reenvíos múltiples**
                    header("Location: productos.php");
                    exit(); // Se asegura que el script no continúe después de la redirección
                
            } else {
                $alert = '<div class="alert alert-danger" role="alert">
                  Datos guardados incorrectamente </div>';
            }
        }
    }


?>


<?php
// Verifica si se ha enviado una imagen
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['imagen'])) {
    // Directorio donde se guardarán las imágenes
    $directorio = 'uploads/';
    
    // Asegurarse de que el directorio exista, si no, crearlo
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }

    // Información del archivo subido
    $nombreArchivo = basename($_FILES['imagen']['name']);
    $rutaArchivo = $directorio . $nombreArchivo;
    $tipoArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));

    // Validar el tipo de archivo
    $tiposPermitidos = array('jpg', 'jpeg', 'png', 'gif');
    if (!in_array($tipoArchivo, $tiposPermitidos)) {
        echo "Error: Solo se permiten archivos de imagen (JPG, JPEG, PNG, GIF).";
        exit;
    }

    // Validar el tamaño del archivo (ejemplo: máximo 2MB)
    $tamanoMaximo = 2 * 1024 * 1024; // 2MB
    if ($_FILES['imagen']['size'] > $tamanoMaximo) {
        echo "Error: El tamaño de la imagen es demasiado grande.";
        exit;
    }

    // Intentar mover el archivo a la ubicación deseada
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
        echo "La imagen se ha subido correctamente: <a href='$rutaArchivo'>$nombreArchivo</a>";
    } else {
        echo "Error al subir la imagen.";
    }
} else {
    echo "No se ha seleccionado ninguna imagen.";
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-regular-rounded/css/uicons-regular-rounded.css'>

    <title>PRODUCTOS</title>
</head>



<body>
    <header>
        <!--ENCABEZADO-->
        <?php include_once("include/encabezado.php"); ?>
        <!--ENCABEZADO-->
    </header>


    <div class="container" style="text-align: center;">
        <h1>Productos disponibles:</h1>
        <?php if ($_SESSION['rol'] == 1) {;   ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">AGREGAR NUEVO PRODUCTO</button>
        <?php    } ?>
    </div>


    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Cantidad de productos</th>
                    <th scope="col">Precio ($)</th>
                    <th scope="col">Color</th>
                    <th scope="col">Tamaño</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Categoria</th>

                    <!--SOLO SE MUESTRA A CIERTOS USUARIOS-->
                    <?php if ($_SESSION['rol'] == 1) {; ?>

                        <th scope="col">Acciones</th>
                    <?php }  ?> <!--SOLO SE MUESTRA A CIERTOS USUARIOS-->
                </tr>

            </thead>

            <tbody>

                <?php include_once("../Servidor/conexion.php");
                $con = mysqli_query(
                    $conexion,
                    //se llama a traer a todos los valores con los que se va a trabajar
                    "SELECT m.idprod,m.nombre,m.descripcion,m.cantidad, m.precio, m.color, m.tamanio, m.foto, j.categoria FROM productos m INNER JOIN categorias j ON m.idcat = j.idcat;"
                );
                $res = mysqli_num_rows($con);
                while ($datos = mysqli_fetch_assoc($con)) {   ?>


                    <tr>
                        <!-- LAS COLUMNAS SERAN REEMPLAZADAS POR LOS VALORES DE LA BD--->
                        <td><?php echo $datos['nombre'];          ?></td>
                        <td><?php echo $datos['descripcion'];          ?></td>
                        <td><?php echo $datos['cantidad'];          ?></td>
                        <td><?php echo $datos['precio'];          ?></td>
                        <td><?php echo $datos['color'];          ?></td>
                        <td><?php echo $datos['tamanio'];          ?></td>
                        <td><?php echo $datos['foto'];          ?></td>
                        <td><?php echo $datos['categoria'];          ?></td>



                        <?php
                        //se abre llave (amarilla) para mostrar solo lo que queremos que muestre a tal usuario
                        if ($_SESSION['rol'] == 1) {;     ?>
                            <!--BOTON DE EDITAR-->
                            <td><a href="editar_producto.php? id= <?php echo $datos['idprod'] ?>">
                                    <button type="button" class="btn btn-secondary"><i class="fi fi-rr-blog-pencil"></i>
                                    </button>
                                </a>
                                <!--BOTON DE BORRAR-->
                                <a href="../Servidor/borra_producto.php?id=  <?php echo $datos['idprod'] ?>">
                                    <button type="button" class="btn btn-danger"><i class="fi fi-rr-trash-xmark"></i>
                                    </button>
                                </a>
                            </td>

                            <!--SE CIERRA LA LLAVE PARA MOSTRAR A CIERTOS USUARIOS -->
                        <?php   } ?>

                    </tr>

                <?php  } ?>

            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>






    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de Productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form method="POST">
                        <div><?php echo isset($alert) ? $alert : ""; ?></div>
                        <div class="form-group">
                        <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre">
                        </div>
                        <br>
                        <div class="form-group">
                        <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion">
                        </div>
                        <br>
                        <div class="form-group">
                        <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad">
                        </div>
                        <br>
                        <div class="form-group">
                        <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" name="precio">
                        </div>
                        <br>
                        <div class="form-group">
                        <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" name="color">
                        </div>
                        <br>
                        <div class="form-group">
                        <label for="tamanio" class="form-label">Tamaño</label>
                            <input type="text" class="form-control" name="tamanio">
                        </div>
                        <br>
                        <div class="form-group">
                        <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto">
                        </div>
                        
                        <label for="categoria" class="form-label">Seleccione su categoria</label>
                        
                        <select class="form-select" name="idcat">
                            <?php
                            $cone = mysqli_query($conexion, "SELECT * FROM categorias");
                            while ($datos = mysqli_fetch_assoc($cone)) {
                            ?>
                            <option value="<?php echo $datos['idcat']; ?>"><?php echo $datos['categoria']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Termina modal -->





    <footer>
        <!--PIE-->
        <?php include_once("include/pie.php"); ?>
        <!--PIE-->
    </footer>

</body>




</html>