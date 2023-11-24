<?php include('../templates/header.html');   ?>

<body>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $atributos = $_GET['atributos'];
    $nombre_tabla = $_GET['nombre_tabla'];
    $criterio = $_GET['criterio'];
    
    $query = "SELECT $atributos FROM $nombre_tabla WHERE $criterio";
    $result = $db -> prepare($query);
    $result -> execute();
    $dataCollected = $result->fetchAll(PDO::FETCH_ASSOC);
    $columnHeaders = array_keys($dataCollected[0]);

    // Crear y escribir en el archivo consulta.txt
    //$file = fopen('consulta.txt', 'w') or die("No se pudo escribir en el archivo");

    // Escribir encabezados de columnas
    //fwrite($file, implode("\t", $columnHeaders) . PHP_EOL);

    // Escribir filas de la tabla
    /*foreach ($dataCollected as $row) {
        fwrite($file, implode("\t", $row) . PHP_EOL);
    }*/

    //fclose($file);
    //echo "Consulta realizada correctamente. Resultados guardados en consultas.txt";

    ?>

    <div class='container' style="width: 70%">
        <h3>Resultado de la consulta:</h3>
        <table class="table">
            <thead>
                <tr>
                    <?php
                    // Imprimir encabezados de columnas
                    foreach ($columnHeaders as $column) {
                        echo "<th>$column</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Imprimir filas de la tabla
                foreach ($dataCollected as $row) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>



    <!-- Agrega un botón para descargar el archivo 
    <div class='container' style="width: 70%">
        <a href="consultas.txt" download="consultas.txt" class="btn btn-primary">Descargar Resultados</a>
    </div>
    -->
<?php include('../templates/footer.html'); ?>