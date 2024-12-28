<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://fontawesome.com/icons/magnifying-glass?f=classic&s=solid"></script>
    <link rel="stylesheet" href="profesionales.css">
    <title>System Clinica Turner</title>
</head>
<body>
<div class="contenido">
    <header>
        <div class="contenido-header">
            <h1>S.C.T</h1>
            <nav id="nav" class="">
                <ul id="links">
                    <li><a href="index.php" class="seleccionado">INICIO</a></li>
                    <li><a href="buscador.php">BUSCAR MI TURNO</a></li>
                    <li><a href="ingresar.php">INGRESAR PACIENTE</a></li>
                    <li><a href="addProfe.php">INGRESAR PROFESIONAL</a></li>
                </ul>
            </nav>
        </div>
    </header>

<div class="buscador">
    <input type="text" placeholder="Buscar">
    <button><i class="fa-solid fa-magnifying-glass"></i></button>
</div>    

<div class="medicos-contenedor">
    <?php
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=clinicabd', 'root', '');
        $consulta = $conexion->query("
            SELECT profesionales.idprofesionales, profesionales.nomyape, especialidades.esp_nombre 
            FROM profesionales 
            INNER JOIN especialidades 
            ON profesionales.especialidades_idespecialidades = idEspecialidades
        ");

        $profesionales = $consulta->fetchAll(PDO::FETCH_ASSOC);

        if (count($profesionales) > 0) {
            foreach ($profesionales as $fila) {
                echo '<div class="contenedor">';
                echo "<img class='medico-img' src='medico.png' alt='Foto del médico'>";
                echo '<h2>' . $fila['nomyape'] . '</h2>';
                echo '<h3>Especialidad: ' . $fila['esp_nombre'] . '</h3>';
                echo '<button class="boton" data-id="' . $fila['idprofesionales'] . '" data-medico="' . $fila['nomyape'] . '">Pedir turno</button>';
                echo '</div>';
            }
        } else {
            echo '
                <div class="sin-profesionales">
                    <p>No hay profesionales disponibles en este momento.</p>
                    <button onclick="redirigir()">Añadir Profesionales</button>
                </div>
            ';
        }
    } catch (PDOException $e) {
        echo 'Fallo la conexión:', $e->getMessage();
    }
    ?>
</div>
    <div id="formulario" class="formulario-clinica">
        <span class="cerrar">&times;</span>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h1 class="tituloform">Solicitar Turnos</h1><br>
            
        <label for="medico" class="form-label">Médico</label><br>
        <input type="text" name="medico" id="medico" value="" class="form-input" readonly><br><br>

        <input type="hidden" name="id_medico" id="id_medico" value="">

            <label for="dni" class="form-label">DNI</label><br>
            <select class= "form-select" name="dni" id="" placeholder="seleccione"> 
            
                <?php
                    try {
                        $conexion = new PDO('mysql:host=localhost;dbname=clinicabd', 'root', '');
                        
                        $datos = $conexion->query("SELECT * FROM `pacientes`");

                        foreach ($datos as $datoDB) {
                            echo '<option class="form-select" value="' . $datoDB['idpacientes'] . '">' . $datoDB['pacdni'] . '</option>';
                        }                       
                    } catch (PDOException $e) {
                        echo 'Fallo la conexión:', $e->getMessage();
                    }
                ?>
            </select><br><br>

            <label for="obrasocial" class="form-label">Obra Social</label><br>
            <input type="text" name="obrasocial" id="obrasocial" class="form-input" placeholder="Ingrese su obra social"><br><br>

            <label for="datetime" class="form-label">Fecha y hora disponible</label><br>
            <input type="datetime-local" name="datetime" id="datetime" class="form-input" required><br><br>

            <input type="submit" class="form-boton" value="Solicitar turno">
        </form>
    </div>
<div>

</div>
    <?php
    if ($_POST) {
        try {
            $conexion = new PDO('mysql:host=localhost;dbname=clinicabd', 'root', '');
            
            $datatime = $_POST['datetime'];
            $id_medico = $_POST['id_medico'];
            print_r($id_medico." este es el id ");
            $id_paciente = $_POST['dni'];

            $sql = "INSERT INTO `turnos` (`idturnos`, `fecha y hora`, `cancelado`, `profesionales_idprofesionales`, `pacientes_idpacientes`) VALUES (NULL, :fecha_hora, NULL, :id_medico, :id_paciente)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([':fecha_hora' => $datatime,':id_medico' => $id_medico,':id_paciente' => $id_paciente]);

            echo "Turno guardado correctamente."; 

        } catch (PDOException $e) {
            echo 'Fallo la conexión: ', $e->getMessage();
        }
    }
    
    ?>
</div>
<script src="scrips.js"></script>
</body>
</html>
