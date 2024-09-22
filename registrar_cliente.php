<?php  
include "./class_libreria.php";
?>

<?php  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cliente = new Cliente();
    $cliente->crearCliente();   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="registrar_cliente.php" method="post">

        <label>Nombre: </label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label>Telefono: </label>
        <input type="number" id="telefono" name="telefono" required>
        <br><br>

        <input type="submit" value="Registrar">

    </form>
    <br><br>
    <a href="lista_clientes_libreria.php">Lista de clientes</a>
</body>
</html>