<?php 
    include('../templates/header.html');  
    session_start(); 
?>

<body>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $proveedor = $_POST['proveedor_id'];
    $contenido = $_POST['contenido_id'];

    $id_usuario = $_SESSION['id_usuario'];

    /*
    $queryseries1 = "SELECT v.titulo, of.precio, p.id_usuario
                    FROM videojuegos as v,ofrece as of
                    WHERE id_usuario = :id_usuario AND v.id_videojuego = of.id_videojuego AND 
                    v.id_videojuego NOT IN (SELECT id_videojuego FROM pagos)";
    $result1 = $db2 -> prepare($queryseries1);
    $result1 -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result1 -> execute();
    $CantidadSeries1 = $result1 -> fetchAll();
    
    $queryseries1 = "SELECT v.titulo, of.precio, p.id_usuario
                    FROM videojuegos as v, ofrece as of, pagos as p
                    WHERE p.id_usuario = :id_usuario 
                    AND v.id_videojuego = of.id_videojuego 
                    AND v.id_videojuego NOT IN (SELECT id_videojuego FROM pagos)";
    $result1 = $db2 -> prepare($queryseries1);
    $result1 -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result1 -> execute();
    $CantidadSeries1 = $result1 -> fetchAll();*/

    $queryseries = "SELECT v.titulo, p.monto, p.fecha_pago, p.id_usuario
                    FROM pagos as p,videojuegos as v
                    WHERE id_usuario = :id_usuario 
                    AND v.id_videojuego = p.id_videojuego";
    $result2 = $db2 -> prepare($queryseries);
    $result2 -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $result2 -> execute();
    $CantidadSeries = $result2 -> fetchAll();

    ?>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center">Historial de compras</h1>
        <div>
            <p style="text-align:center;">
                Compras por confirmar 
            </p>
            <div style="display: flex; justify-content: center;">
                <table>
                    <tr>
                        <th>nombre_videojuego</th>
                        <th>precio</th>
                    </tr>
                    <?php
                    foreach ($CantidadSeries1 as $p1) {
                        echo "<tr> <td>$p1[0]</td> <td>$p1[1]</td> <td>$p1[2]</td>  </tr>";
                    }
                    ?>
                
                </table>
            </div>
        </div>

        <div>
            <p style="text-align:center;">
                Compras confirmadas de pago unico
            </p>
            <div style="display: flex; justify-content: center;">
                <table>
                    <tr>
                        <th>nombre_videojuego</th>
                        <th>monto</th>
                        <th>fecha_pago</th>
                        <th>id_usuario</th>
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