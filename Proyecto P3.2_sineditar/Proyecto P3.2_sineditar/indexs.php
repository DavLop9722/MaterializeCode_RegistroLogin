<!-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href= "Asset/css/style.css"></link>
    <script src="Asset/js/text.js"></script>

</head>
<body>
    <header id="cabeceralogo">
        <h1>Bienvenido a  MaterializeCode! </h1>
    </header>
        <nav id="menuprincipal">
            <div>
                <ul id="listamenu">
                    <li><a href="index.html">Principal</a></li>
                        
                         <li><a href="bd.html"> Ver Datos</a></li>
                         <li><a href="modbd.html">Modificar Datos</a></li>
                        
                    
                    <li><a href="videos.html">Videos</a></li> 
                    <li><a href="contacto.html">Contacto</a></li>
                </ul>
            </div>
        </nav>
    <main>
      
        <section>
            <article>
                <nav>
                    <input type="button" name="boton-desp" value="Desplegar" onclick="">
                </nav>
                <div class="estudiante">
                    <ul >
                    <li><a href="maeterias.html"> Ver materias</a></li>
                    <li><a href="archivos.html">Mostrar archivos</a></li>
                    <li><a href="Mensajeria..html">Mensajeria</a></li>
                    <input type="button" name="button-1" value="Anterior" onclick="">
                    <input type="button" name="button-1" value="Siguiente" onclick="">

                   </ul>
                </div>
                    
            </article>
            <article>
                <div class="estudiante">
                    <ul>
                        <h1>Estudiantes</h1>
                        <li><a href="formulario.html">Materiales</a>
                            <ul>
                             <li><a href="bd.html"> Libros</a></li>
                             <li><a href="modbd.html">Administrador</a></li>
                            </ul>
                        </li>
                        <li><a href="videos.html">Reportes(pizarra)</a></li> 
                        <li><a href="contacto.html">Asistencia</a></li>
                    </ul>
                </div>
                
            </article>

        </section>
        <aside id="infoadicional">
            <h1>Información Personal</h1>
            <p>Cita del artículo uno</p>
            <p>Cita del artículo dos </p>
        </aside>
    </main>
    <footer>

    </footer>
</body>
</html> -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido Administradores</title>
    <link rel="stylesheet" href="Asset/css/administrador.css">
    <script type="text/javascript" src="./Asset/js/text.js"></script>
</head>
<body class="grid-container">
    
    <header class="header">
        <p>MaterializeCode</p>
    <img id="imagen" src="Asset/img/Logo-ISFD.png" alt="instituto.jpg">
    </header>

    <nav class="nav-bar">
        <ul>
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#institucional">Institucional</a></li>
            <li><a href="#ayuda">Ayuda</a></li>

            <botton class="mensajeria">Mensajeria</botton>
        </ul>
    </nav>
    <section class="section">

        <article class="art0">
            <h2>Administrador</h2>
            <ul>
                <li>
                    <a href="mensajecoordinador.html">Coordinador</a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                    </svg> 
                </li>
            </ul>
            
    
            <!-- <button id="buttonP">Dar Permisos</button>
            <button id="buttonN">Lanzar notificación</button> -->
    
        </article>
        <article class="art2">
           <label for="carreras">Selecciona la Carrera</label>
           <select name="carreras" id="carrera">
                <option value="base de datos 1">Enfermeria</option>
                <option value="programacion1">Software</option>
                <option value="ofimatica">Lengua y Literatura</option>
           </select>
        </article>
        <article class="art1">
            <ul>
                <li class="botones-opciones">Administrar Coordinadores</li>
                <li class="botones-opciones">Administrar Profesores</li>
                <li class="botones-opciones">Administrar Alumnos</li>
            </ul>
        </article>
        <article>
            <?php   
        define('CONTROLLERS_FOLDER', "Controller/estudiante/");
        define('DEFAULT_CONTROLLER', "Estudiante");
        define('DEFAULT_ACTION', "Estudiante_Controlador::mostrarEstudiantes");

        $controller = DEFAULT_CONTROLLER;
        if ( !empty ($_GET['controller']) ) {
            $controller = $_GET['controller'];
        }

        $action = DEFAULT_ACTION;
        if ( !empty($_GET['action']) ) {
            $action = $_GET['action'];
        }
    
        $controller = CONTROLLERS_FOLDER . $controller . '_Controlador.php';

        try {
            if ( is_file ($controller) ) {
                require_once ($controller);
            } else {
                throw new Exception ('El controlador no existe - 404 not found');
                die ('El controlador no existe - 404 not found');
            }

            if ( is_callable($action) ) {
                $action();
            } else {
                throw new Exception ('La acción no existe - 404 not found');
                // die ('La acción no existe - 404 not found');
            }
        } catch(Exception $e) {
            echo $e->getMessage();
        }   
            ?>
        </article>
    </section>
    
    <footer class="footer">
       
       <p>MaterializeCode todos los derechos reservados 2024</p> 

    </footer>
    
</body>
</html>