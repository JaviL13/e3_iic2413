<?php 
    include('../templates/header.html');   
    session_start();
?>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 60%; /* Ancho de la tabla */
            margin: auto; /* Centrar la tabla */
        }

        th, td {
            padding: 10px; /* Espacio interno en celdas */
            text-align: left; /* Alineación del texto en celdas */
            border: 1px solid #008080;/* Borde de las celdas */
        }

        tr {
            background-color: #8cbaba; /* Color de fondo para las filas */
            color: #000000; /* Color del texto en las filas */
        }
    </style>
    <title>Comprar peli</title>
</head>


<body>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $proveedor = $_POST['proveedor_id'];
    $contenido = $_POST['contenido_id'];
    $user_id = $_SESSION['id_usuario'];


    $queryseries = "SELECT pl.nombre, pu.monto, pu.fecha_pago, pr.nombre
                    FROM pagos_unicos as pu, proveedores as pr, peliculas as pl
                    WHERE pu.id_usuario = :user_id
                    AND pu.id_proveedor = pr.id
                    AND pu.id_pelicula = pl.id";
    $result2 = $db -> prepare($queryseries);
    $result2 -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $result2 -> execute();
    $CantidadSeries = $result2 -> fetchAll();


    ?>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center">Historial de compras</h1>
        <div>
            <p style="text-align:center;">
                Compras por confirmar 
            </p>
        </div>
        
        <div>
            <p style="text-align:center;">
                Compras confirmadas
            </p>
            <div style="display: flex; justify-content: center;">
                <table>
                    <tr>
                        <th>  Pelicula  </th>
                        <th>  monto  </th>
                        <th>  fecha pago  </th>
                        <th>  Proveedor  </th>
                    </tr>
                    <?php
                    foreach ($CantidadSeries as $p) {
                        echo "<tr> <td>$p[0]</td> <td>$p[1]</td> <td>$p[2]</td> <td>$p[3]</td>  </tr>";
                    }
                    ?>
                
                </table>
            </div>
        </div>

    </div>

    

<?php include('../templates/footer.html'); ?>