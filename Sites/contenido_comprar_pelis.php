<?php include('templates/header.html');   ?>
<?php
$idPeli = $_GET['msg']; 
?>
<?php
#Llama a conexión, crea el objeto PDO y obtiene la variable $db
require("config/conexion.php");
$query = "SELECT nombre, duracion, puntuacion, año, clasificacion
          FROM peliculas
          WHERE id = $idPeli";

$result = $db -> prepare($query);
$result -> execute();
$dataCollected = $result -> fetchAll();

$queryPeliculas_Genero = "SELECT g.nombre
                            FROM peli_generos as pg, genero as g
                            WHERE pg.id_pelicula = $idPeli
                            and pg.id_genero = g.id";

$resultPeliculas_Genero = $db -> prepare($queryPeliculas_Genero);
$resultPeliculas_Genero -> execute();
$peliculas_genero = $resultPeliculas_Genero -> fetchAll();
?>

<body>
    <div class='main'>
        <h1 class='title' style="color:#008080" align="center"><?php echo $dataCollected[0]['nombre']?></h1>
        <br>
        <br>
        
        <!-- -->
        <div class="card" style="width: 18rem; margin-right: 10rem; margin-left: 10rem;" >
            <div class="card-body">
                <p class="card-text">
                  Generos: <?php foreach ($peliculas_genero as $PG) {echo "$PG[0]     ";}?>
                </p>
                <p class="card-text">Clasificacion: <?php echo $dataCollected[0]['clasificacion']?></p>
                <p class="card-text">Puntuacion: <?php echo $dataCollected[0]['puntuacion']?></p>
                <p class="card-text">Año: <?php echo $dataCollected[0]['año']?></p>
                <p class="card-text">Duracion: <?php echo $dataCollected[0]['duracion']?></p>
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
        require("config/conexion.php");

        $queryPeliculas_Proveedor = "SELECT DISTINCT p.nombre, pv.cargo, p.id
                                    FROM pelis_vende as pv, proveedores as p
                                    WHERE pv.id_pelicula = $idPeli
                                    AND p.id = pv.id_proveedor";

        $resultPeliculas_Proveedor = $db -> prepare($queryPeliculas_Proveedor);
        $resultPeliculas_Proveedor -> execute();
        $peliculas_proveedor = $resultPeliculas_Proveedor -> fetchAll();

        ?>
        <table>
          <tr>
            <th>Proveedores</th>
            <th>Precio</th>
          </tr>
          <?php
            foreach ($peliculas_proveedor as $PP) {
                echo "<tr> <td>$PP[0]</td> <td>$PP[1]</td> </tr>";
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
                foreach ($peliculas_proveedor as $PP) {
                  echo "<option value=$PP[2] name='proveedor'>$PP[0]</option>";
                }
              ?>
            </select>
            <!-- Agregar un campo oculto para almacenar el ID del proveedor -->
            <?php
            // Asumiendo que $peliculas_proveedor es un array asociativo con índices 0, 1 y 2
            // y que el ID del proveedor está en $PP[2]
            echo "<input type='hidden' name='proveedor_id' value='$PP[2]'>";
            echo "<input type='hidden' name='contenido_id' value='$idPeli'>";
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
