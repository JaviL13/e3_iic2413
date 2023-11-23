<?php include('../templates/header.html');   ?>

<body>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $proveedor = $_POST['proveedor_id'];
    $contenido = $_POST['contenido_id'];

    echo "$proveedor   ";
    echo $contenido;

    $queryVideojuegos_Proveedor = "SELECT username, password
                                    FROM usuarios";

    $resultVideojuegos_Proveedor = $db -> prepare($queryVideojuegos_Proveedor);
    $resultVideojuegos_Proveedor -> execute();
    $videojuegos_proveedor = $resultVideojuegos_Proveedor -> fetchAll();
    ?>

    <table>
        <tr>
          <th>Proveedores</th>
          <th>Proveedores</th>
        </tr>
        <?php
          foreach ($videojuegos_proveedor as $VjP) {
              echo "<tr> <td>$VjP[0]</td> <td>$VjP[1]</td></tr>";
          }
        ?>
              
    </table>  

    

<?php include('../templates/footer.html'); ?>