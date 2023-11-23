<?php include('../templates/header.html');   ?>

<body>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $atributos = $_GET['atributos'];
    $nombre_tabla = $_GET['nombre_tabla'];
    $criterio = $_GET['criterio'];

    echo "$atributos  $nombre_tabla $criterio ";

    ?>

    

<?php include('../templates/footer.html'); ?>