<br>
<br>
<?php
    $idProveedor = $_GET['idProveedor']; 
?>
<form align="center" action="todos_proveedores.php?id=<?php echo $idProveedor; ?>" method="post">
    <input type="submit" value="Volver">
</form>
<br>
<form align='center' action="index.php" method="get">
    <input type="submit" value="Menu Principal">
</form>
</body>

</html>