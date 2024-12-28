<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="ingresarPacientes.css">
    <title>System Clinica Turner</title>
</head>
<body>
    <!-- SECCION I N I C I O -->
    <section id="inicio">
    <div class="contenido">

    <!-- contenido del menu -->
            <header>
                <div class="contenido-header">
                    <h1>S.C.T</h1>
                    <nav id="nav" class="">
                        <ul id="links">
                            <li><a href="index.php" class="seleccionado">INICIO</a></li>
                            <li><a href="buscador.php">BUSCAR MI TURNO</a></li>
                            <li><a href="ingresar.php">INGRESAR UN PACIENTE</a></li>
                            <li><a href="profesionales.php">PROFESIONALES</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <br>
            <br>


    <!------------------------->

    </div>
    <!-- formulario -->
    <div class="formulario-clinica">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <h1 class="tituloform">Nuevo Profesional</h1><br>
            <!-- Nombre -->
            <label for="nombre" class="form-label">Nombre y Apellido</label><br>
            <input type="text" name="nombre" id="nombre" class="form-input" placeholder="Ingrese su Nombre y Apellido" required><br><br>

            <!-- matricula -->
            <label for="matricula" class="form-label">matricula</label><br>
            <input type="text" name="matricula" id="matricula" class="form-input" placeholder="Ingrese su DNI" required><br><br>

            <!-- telefono -->
            <label for="telefono" class="form-label">Telefono</label><br>
            <input type="text" name="tel" id="tel" class="form-input" placeholder="Telefono" required><br><br>

            <!-- domicilio -->
            <label for="domicilio" class="form-label">Domicilio</label><br>
            <input type="text" name="domicilio" id="domicilio" class="form-input" placeholder="Ingrese su domicilio"><br><br>
            
            <!-- email-->
            <label for="email" class="form-label">Email</label><br>
            <input type="email" name="email" id="email" class="form-input" required placeholder="Email"><br><br>

            <!-- Especialidad -->
            <label for="especialidad" class="form-label">Especialidad</label><br>
            <select name="especialidad" id="" placeholder="seleccione"> 
            
                <?php
                    try {
                        // Conexión a la base de datos
                        $conexion = new PDO('mysql:host=localhost;dbname=clinicabd', 'root', '');
                        
                        // Obtener las especialidades de la base de datos
                        $datos = $conexion->query("SELECT * FROM `especialidades`");

                        foreach ($datos as $datoDB) {
                            echo '<option value="' . $datoDB['idEspecialidades'] . '">' . $datoDB['esp_nombre'] . '</option>';
                        }

                        
                    } catch (PDOException $e) {
                        echo 'Fallo la conexión:', $e->getMessage();
                    }
                ?>
            </select>
            <!-- Botón de envío -->
            <input type="submit" class="form-boton" value="Crear profesional">
        </form>

    </div>
    <!--------------->
    <?php 
try {
    if ($_POST) {
        $nombre = $_POST['nombre'];
        $matricula = $_POST['matricula'];
        $telefono = $_POST['tel'];
        $domicilio = $_POST['domicilio'];
        $email = $_POST['email'];
        $especialidad = $_POST['especialidad'];

        // Conexión a la base de datos
        $conexion = new PDO('mysql:host=localhost;dbname=clinicabd', 'root', '');
        echo "Conexión OK<br>";

    // --------------------------------------------------------------------------------
         $conexion->query("INSERT INTO `profesionales` (`idprofesionales`, `nomyape`, `matricula`, `domicilio`, `proftele`, `profemail`, `especialidades_idespecialidades`) VALUES (NULL, '$nombre', '$matricula', '$domicilio', '$telefono', '$email', '$especialidad');");
    }
} catch (PDOException $e) {
    echo '<h1>Fallo la conexión:</h1> ', $e->getMessage();
}
?>
    </section>
    <script src="scrips.js"></script>
</html>




