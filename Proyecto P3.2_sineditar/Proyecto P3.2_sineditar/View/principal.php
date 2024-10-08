

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Página de Bienvenida</title>
   
    <link rel="stylesheet" href="../Asset/css/principal.css">
     <!-- Bootstrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
        <div class="img-principal">
       
        
    </div>
    <div class="logo">
            
    </div>
    <div class="bienvenida">
        <!-- Título -->
        <h1>Bienvenido a <br> MaterializeCode!</h1>
    </div>
    <br><br>
    <div class="botones">
        <!-- Botones de Pirncipal -->
        <button class="btn btn-light" onclick="location.href='login.php'">Iniciar Sesión</button>
        <button class="btn btn-light" onclick="location.href='registro.php'">Registrarse</button>
    </div>
    <br><br>


<!-- Menú-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">MaterializeCode</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Instituto</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                  </li>
                 
                </ul>
              </div>
            </div>
          </nav>
 
          <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../Asset/img/imagen1.jpg" class="d-block w-100" alt="img1">
              </div>
              <div class="carousel-item">
                <img src="../Asset//img//imagen2.jpg" class="d-block w-100" alt="img2">
              </div>
              <div class="carousel-item">
                <img src="../Asset/img/imagen3.jpg" class="d-block w-100" alt="img3">
              </div>
              <div class="carousel-item">
                <img src="../Asset/img/imagen4.jpg" class="d-block w-100" alt="img4">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Siguiente</span>
            </button>
          </div>


</body>
</html>