<?php
include "./conexion_db.php";

?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id_cliente = $_POST['id_cliente'];
  $sql = "DELETE from clientes WHERE id_cliente={$id_cliente}";
  if (ConexionDb::conexion_db()->query($sql) == TRUE) {
    echo "Producto $id_cliente eliminado con exito";
  } else {
    echo "Error: " . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de clientes libreria</title>
</head>

<body>

  <h1>Lista de clientes libreria</h1>

  <table class="table" border="1">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Nombre</th>
        <th scope="col">Telefono</th>
    </thead>
    <tbody>

      <?php
      $sql = "SELECT * FROM clientes";
      $result = ConexionDb::conexion_db()->query($sql);
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<tr>
                        <th scope='row'>{$row['id_cliente']}</th>
                        <td>{$row['nombre']}</td>
                        <td>{$row['numero_telefono']}</td>
                    </tr>";
        }
      } else {
        echo "<tr><td colospan='5'>No hay clientes</td></tr>";
      }
      ConexionDb::conexion_db()->close();

      ?>

    </tbody>
  </table>
  <br><br>
  <a href="registrar_cliente.php">Registrar nuevo cliente</a>
  <br><br>
  <a href="crear_prestamo.php">Alquilar un libro</a>
</body>

</html>

<?php


?>