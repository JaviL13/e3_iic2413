<?php include('templates/header.html');   ?>
<?php
$idVideoJuegos = $_GET['id']; 

?>
<?php
#Llama a conexión, crea el objeto PDO y obtiene la variable $db
require("config/conexion.php");
$query = "SELECT titulo, puntuacion, clasificacion, fecha, beneficio_preorden
          FROM videojuegos
          WHERE id_videojuego = $idVideoJuegos";


$result = $db2 -> prepare($query);
$result -> execute();
$dataCollected = $result -> fetchAll();

$queryVideojuegos_Genero = "SELECT genero
                            FROM vj_genero
                            WHERE id_videojuego = $idVideoJuegos";

$resultVideojuegos_Genero = $db2 -> prepare($queryVideojuegos_Genero);
$resultVideojuegos_Genero -> execute();
$videojuegos_genero = $resultVideojuegos_Genero -> fetchAll();

?>



<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center"><?php echo $dataCollected[0]['titulo']?></h1>
        </br>
        </br>
        
        <!-- -->
        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;" >
            <div class="card-body">
                <p class="card-text">
                  Generos:<?php foreach ($videojuegos_genero as $VjG) {echo "$VjG[0]      ";}?>
                </p>
                <p class="card-text">Clasificacion: <?php echo $dataCollected[0]['clasificacion']?></p>
                <p class="card-text">Puntuacion: <?php echo $dataCollected[0]['puntuacion']?></p>
                <p class="card-text">Fecha: <?php echo $dataCollected[0]['fecha']?></p>
                <p class="card-text">Beneficio Preorden: <?php echo $dataCollected[0]['beneficio_preorden']?></p>
            </div>
        </div>
        <br>
        <br>

        <!-- -->
        <p style="text-align:center;">
          Tabla con proveedor que lo ofrece y sus precios 
          
        </p>
        <div class='container'>
        <?php
        #Llama a conexión, crea el objeto PDO y obtiene la variable $db
        require("config/conexion.php");


        $queryVideojuegos_Proveedor = "SELECT p.nombre, o.precio, p.id_proveedor
                                    FROM ofrece as o, proveedoresvj as p
                                    WHERE o.id_videojuego = $idVideoJuegos
                                    AND o.id_proveedor = p.id_proveedor";

        $resultVideojuegos_Proveedor = $db2 -> prepare($queryVideojuegos_Proveedor);
        $resultVideojuegos_Proveedor -> execute();
        $videojuegos_proveedor = $resultVideojuegos_Proveedor -> fetchAll();
        ?>
          <table>
            <tr>
              <th>Proveedores</th>
              <th>Precio</th>
            </tr>
            <?php
              foreach ($videojuegos_proveedor as $VjP) {
                  echo "<tr> <td>$VjP[0]</td> <td>$VjP[1]</td></tr>";
              }
            ?>
              
          </table>
        </div>
        <br>
        <br>
        
        <!-- -->
        <div class='container' style="width: 70%">
          <h3>Seleciona un proveedor para comprar</h3>
          <br>
          <form action='consultas/prodecimiento02.php' method='post'>
            <select class="form-select form-select-lg mb-3" aria-label="Large select example">
              <?php
                foreach ($videojuegos_proveedor as $VjP) {
                  echo "<option value=$VjP[2]>$VjP[0]</option>";
                }
              ?>
            </select>
            <?php
            // Asumiendo que $peliculas_proveedor es un array asociativo con índices 0, 1 y 2
            // y que el ID del proveedor está en $PP[2]
            echo "<input type='hidden' name='proveedor_id' value='$VjP[2]'>";
            echo "<input type='hidden' name='contenido_id' value='$idVideoJuegos'>";
            ?>
            <button type="submit" class="btn btn-primary" value="Buscar">Submit</button>
          </form>
        </div>


    </div>
  <br>
  <br>
  <br>
</body>
</html>
