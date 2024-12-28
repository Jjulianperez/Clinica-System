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
                            <li><a href="ingresar.php">INGRESAR UN PACIENTE</a></li>
                            <li><a href="profesionales.php">PROFESIONALES</a></li>
                            <li><a href="addProfe.php">INGRESAR PROFESIONAL</a></li>
                        </ul>
                    </nav>
                </div>
            </header>
        <!-------------------------------------->
    </div>
    <br>
    <br>
    <br>
    <div class="formulario-clinica">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <h1 class="tituloform">Buscar Mi Turno</h1><br>
            <label 
            for="dni" 
            class="form-label">DNI</label><br>
            <input type="text" name="dni" id="dni" class="form-input" placeholder="Ingrese su DNI" required><br><br>

            <input type="submit" class="form-boton" value="Buscar turno">
        </form>
    </div>
    </section>
</html>


<?php 
try {
    if ($_POST) {
        $busDni = $_POST['dni'];

        $conexion = new PDO('mysql:host=localhost;dbname=clinicabd', 'root', '');
        echo "Conexión OK<br>";

        $paciente = $conexion->query("SELECT idpacientes FROM `pacientes` WHERE `pacdni` = '$busDni'")->fetch(PDO::FETCH_ASSOC);

        if ($paciente) {
            $idPaciente = $paciente['idpacientes'];
            $turnos = $conexion->query("SELECT t.idturnos, t.`fecha y hora` AS fecha_hora, t.cancelado, p.nomyape AS profesional
                                        FROM `turnos` t
                                        JOIN `profesionales` p ON t.profesionales_idprofesionales = p.idprofesionales
                                        WHERE t.pacientes_idpacientes = $idPaciente");

            echo '<div class="contenedor-turnos"><br>';
            echo '<h2>Turnos encontrados:</h2>';
            foreach ($turnos as $turno) {
                echo "<div class='card-turno' id='turno-{$turno['idturnos']}'>";
                echo "<h3>Fecha y Hora:</h3><p>" . $turno['fecha_hora'] . "</p>";
                echo "<h3>Estado:</h3><p>" . ($turno['cancelado'] === 'si' ? "Cancelado" : "Activo") . "</p>";
                echo "<h3>Profesional:</h3><p>" . $turno['profesional'] . "</p>";
                echo "<button class='btn-cancelar'>Cancelar Turno</button>";
                echo "</div>";
            }
            echo "</div>";

            if ($turnos->rowCount() === 0) {
                echo '<div class="contenedor-turnos">';
                echo "No se encontraron turnos para este paciente.<br>";
                echo "</div>";

            }
        } else {
            echo '<div class="contenedor-turnos">';
            echo "El DNI ingresado no existe en la base de datos.<br>";
            echo "</div>";
        }
    }
} catch (PDOException $e) {
    echo 'Fallo la conexión: ', $e->getMessage();
}
?>



