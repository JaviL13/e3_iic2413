<?php include('../templates/header.html');   ?>

<body>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
    $proveedor = $_POST['proveedor_id'];
    $contenido = $_POST['contenido_id'];

    echo "$proveedor   ";
    echo $contenido;

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
        </div>

    </div>

    

<?php include('../templates/footer.html'); ?>