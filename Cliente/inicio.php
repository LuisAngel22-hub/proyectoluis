
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Menú</title>
</head>

<body>
 <!--ENCABEZADO-->
 <header>
    <?php include_once("include/encabezado.php"); ?>
  </header>

  <div class="container">
    <p> <?php  echo $_SESSION['nombre']; echo '  '; echo  $_SESSION['paterno'] ; echo '  ';  echo $_SESSION['materno']; echo '  ';
        ?></p>
  </div>

  <div class="container">
    
  </div>
<!--El carrusel de imagenes-->
 <div class="container">


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/brooklynJersey.jpg" class="d-block w-100" alt="Jersey" width="400px" height="550px">
    </div>
    <div class="carousel-item">
      <img src="img/bullsJersey.jpg" class="d-block w-100" alt="Bjersey" width="400px" height="550px">
    </div>
    <div class="carousel-item">
      <img src="img/tenisJordan.jpg" class="d-block w-100" alt="Bjersey" width="400px" height="550px">
    </div>
    <div class="carousel-item">
      <img src="img/tenisKobe.jpg" class="d-block w-100" alt="Bjersey" width="400px" height="550px">
    </div>
    <div class="carousel-item">
      <img src="img/heatJersey.jpg" class="d-block w-100" alt="Hjersey" width="400px" height="550px">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</div>

  <!--Pie de pagina-->
  <footer style="text-align: center;
      padding: 15px 0;
      width: 100%;">

    <?php include_once("include/pie.php"); ?>
  </footer>
</body>

</html>
