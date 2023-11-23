<?php include('templates/header.html');   ?>

<body>
    <div class='main'>
        <h1 class='title' align="center">Consulta inestructurada</h1>

        <div class='container' style="width: 70%">
            <h3>¡Busca tus peliculas y series favoritas!</h3>
            <form action='consultas/prodecimiento01.php' method='GET'>
                <div class="mb-3">
                    <label for="atributos" class="form-label">Atributos:</label>
                    <input type="text" name="atributos" class="form-control form-control-lg" required>
                </div>
                <div class="mb-3">
                    <label for="nombre_tabla" class="form-label">Nombre de la tabla:</label>
                    <input type="text" name="nombre_tabla" class="form-control form-control-lg" required>
                </div>
                <div class="mb-3">
                    <label for="criterio" class="form-label">Criterio:</label>
                    <input type="text" name="criterio" class="form-control form-control-lg" required>
                </div>
                <input class='btn btn-light' type='submit' value='Consultar'>
            </form>
        </div>
    </div>
  <br>
  <br>
  <br>
</body>
</html>
