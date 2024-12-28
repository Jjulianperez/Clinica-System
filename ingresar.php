-- Active: 1728923128284@@127.0.0.1@3306
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
                            <li><a href="profesionales.php">PROFESIONALES</a></li>
                            <li><a href="addProfe.php">INGRESAR PROFESIONAL</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
            <br>
            <br>
    <!------------------------->

    </div>
    <div class="formulario-clinica">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <h1 class="tituloform">Nuevo paciente</h1><br>
            <label for="nombre" class="form-label">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" class="form-input" placeholder="Ingrese su Nombre" required><br><br>

            <label for="apellido" class="form-label">Apellido</label><br>
            <input type="text" name="apellido" id="apellido" class="form-input" placeholder="Ingrese su Apellido" required><br><br>

            <label for="dni" class="form-label">DNI</label><br>
            <input type="text" name="dni" id="dni" class="form-input" placeholder="Ingrese su DNI" required><br><br>

            <label for="telefono" class="form-label">Telefono</label><br>
            <input type="text" name="tel" id="tel" class="form-input" placeholder="Telefono" required><br><br>

            <label for="domicilio" class="form-label">Domicilio</label><br>
            <input type="text" name="domicilio" id="domicilio" class="form-input" placeholder="Ingrese su domicilio"><br><br>
            
            <label for="email" class="form-label">Email</label><br>
            <input type="email" name="email" id="email" class="form-input" required placeholder="Email"><br><br>

            <label for="cumpleaños" class="form-label">cumpleaños</label><br>
            <input type="date" name="cumple" id="cumple" class="form-input" required placeholder="cumple"><br><br>

            <input type="submit" class="form-boton" value="Crear paciente">

        </form>
    </div>
    <!--------------->
    </section>
</html>

<?php 
try {
    if ($_POST) {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $telefono = $_POST['tel'];
        $domicilio = $_POST['domicilio'];
        $email = $_POST['email'];
        $cumple = $_POST['cumple'];

        $conexion = new PDO('mysql:host=localhost;dbname=clinicabd', 'root', '');
        echo "Conexión OK<br>";

        $dato = $conexion->prepare("INSERT INTO `pacientes` (`idpacientes`, `pacnom`, `pacapellido`, `pacdni`, `pactel`, `pacdomi`, `pacfechanac`, `pacemail`) VALUES (NULL, :nombre, :apellido, :dni, :telefono, :domicilio, ':cumple', :email)");
        
        $dato->bindParam(':nombre', $nombre);
        $dato->bindParam(':apellido', $apellido);
        $dato->bindParam(':dni', $dni);
        $dato->bindParam(':telefono', $telefono);
        $dato->bindParam(':domicilio', $domicilio);
        $dato->bindParam(':email', $email);
        $dato->bindParam(':cumple', $cumple);

        $dato->execute();
        echo "Paciente insertado correctamente";
    }
} catch (PDOException $e) {
    echo 'Fallo la conexión: ', $e->getMessage();
}
?>


<?php
    $conexion = new PDO('mysql:host=localhost;dbname=Remolacha', 'root', '');
    $dato = $conexion->prepare("SELECT nombres FROM alumnos WHERE id = $id");
    echo $id."Nombre"

?>
