<?php 
include('templates/header.html');
include('config/conexion.php');   
session_start();
?>

<body>
    <h1 style="color: #008080;">Mi perfil</h1></br></br>
    <!-- ------------------------------------------------------------------- -->
    <!-- Pon aca la logica de las consultas sobre los datos del Usuario -->
    <?php
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];
        //echo $id_usuario;

        $query = "SELECT nombre, mail, username, fecha_nacimiento
                  FROM usuarios
                  WHERE id_usuario = :id_usuario;";

        $result = $db -> prepare($query);
        # Lo siguiente protege el input de la consulta
        $result -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
        $result -> execute();
        $dataCollected = $result -> fetchAll();

        // Obtener suscripciones activas de videojuegos desde una vista materializada
        $queryVideojuegos = "SELECT titulo FROM vj_activesubs WHERE id_usuario = :idUsuario;";
        $resultVideojuegos = $db2 -> prepare($queryVideojuegos);
        $resultVideojuegos -> bindParam(':idUsuario', $id_usuario, PDO::PARAM_INT);
        $resultVideojuegos -> execute();
        $dataVideojuegosSubs = $resultVideojuegos->fetchAll();

        // Obtener suma de horas jugadas en videojuegos desde una vista materializada
        $queryHorasVideojuegos = "SELECT horas_jugadas FROM horas_juego_usuario WHERE id_usuario = :idUsuario;";
        $resultHorasVideojuegos = $db2 -> prepare($queryHorasVideojuegos);
        $resultHorasVideojuegos -> bindParam(':idUsuario', $id_usuario, PDO::PARAM_INT);
        $resultHorasVideojuegos -> execute();
        $horasVideojuegos = $resultHorasVideojuegos -> fetchColumn();

    } else {
        echo "No se ha iniciado sesión";
    }
    ?>

    <!-- ----------------------------------- -->
    <div class='container align-self-center'>
        <h3 style="color: #008080;">informacion del usuario</h3>
        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;">
            <?php foreach ($dataCollected as $p) : ?>
                <div class="card-header" style="background-color:#F0F8FF">
                    Usuario
                </div>
                <div class="card-body">
                    <p class="card-text">Nombre: <?php echo $p[0]; ?></p>
                    <p class="card-text">Email: <?php echo $p[1]; ?></p>
                    <p class="card-text">Username: <?php echo $p[2]; ?></p>
                    <?php
                    $fechaNacimiento = new DateTime($p[3]);
                    $hoy = new DateTime();
                    $edad = $hoy->diff($fechaNacimiento)->y;
                    ?>
                    <p class="card-text">Edad: <?php echo $edad; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </br></br>
    <!-- ------------------------------------------------------------------- -->
    <!-- Logica listado suscripciones activas de Videojuegos -->
    <!-- y cantidad de horas jugadas -->
    

    <!-- ----------------------------------- -->
    <!-- Logica listado suscripciones activas de streaming -->
    <!-- y cantidad de horas vistas -->
    <?php
    // Obtener suscripciones activas de streaming desde una vista materializada
    $queryStreaming = "SELECT nombre FROM streaming_subs WHERE uid = :idUsuario;";
    $resultStreaming = $db -> prepare($queryStreaming);
    $resultStreaming -> bindParam(':idUsuario', $id_usuario, PDO::PARAM_INT);
    $resultStreaming -> execute();
    $dataStreaming = $resultStreaming -> fetchAll();
    // Obtener suma de horas vistas en películas y series
    $queryHorasPeliculas = "SELECT horas FROM horas_pelis_user WHERE id_usuario = :idUsuario;";
    $resultHorasPeliculas = $db -> prepare($queryHorasPeliculas);
    $resultHorasPeliculas -> bindParam(':idUsuario', $id_usuario, PDO::PARAM_INT);
    $resultHorasPeliculas -> execute();
    $horasPeliculas = $resultHorasPeliculas -> fetchColumn();

    $queryHorasSeries = "SELECT horas FROM horas_series_user WHERE id_usuario = :idUsuario;";
    $resultHorasSeries = $db -> prepare($queryHorasSeries);
    $resultHorasSeries -> bindParam(':idUsuario', $id_usuario, PDO::PARAM_INT);
    $resultHorasSeries -> execute();
    $horasSeries = $resultHorasSeries -> fetchColumn();
    ?>

    <!-- ----------------------------------- -->
    <div class='container align-self-center'>
        <h3 style="color: #008080;">suscripciones actuales</h3>
        <div class="row" style="margin-right: 1rem; margin-left: 1rem;">
            
            <div class="col-sm-6 ">
                <div class="card">
                    
                    <div class="card-header"  style="background-color:#F0F8FF">
                        Videojuegos
                    </div>
                    <div class="card-body">
                        <?php foreach ($dataVideojuegosSubs as $v) : ?>
                        <p class="card-text"> <?php echo $v[0];?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer text-muted">
                        Cantidad de horas jugadas: <?php echo $horasVideojuegos; ?>
                    </div>
                    
                </div>
            </div>
                <div class="col-sm-6">
                    <div class="card">
                    <div class="card-header"  style="background-color:#F0F8FF">
                        Peliculas
                    </div>
                    <div class="card-body">
                        <?php foreach ($dataStreaming as $p) : ?>
                        <p class="card-text"> <?php echo $p[0]; ?></p>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer text-muted">
                        cantidad de horas vistas peliculas: <?php echo $horasPeliculas; ?>
                        </br>
                        cantidad de horas vistas series: <?php echo $horasSeries; ?>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>


<?php include('templates/footer_proveedores.html'); ?>