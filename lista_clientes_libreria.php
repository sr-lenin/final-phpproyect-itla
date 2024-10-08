<?php
include "./conexion_db.php";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_cliente = $_POST['id_cliente'];
  $sql = "DELETE from clientes WHERE id_cliente={$id_cliente}";
  if (ConexionDb::conexion_db()->query($sql) == TRUE) {
    echo "<div class='alert alert-success'>Cliente $id_cliente eliminado con éxito</div>";
  } else {
    echo "<div class='alert alert-danger'>Error: " . ConexionDb::conexion_db()->error . "</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de clientes librería</title>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 50px;
    }
    h1 {
      color: #563d7c;
      margin-bottom: 30px;
    }
    .table th, .table td {
      vertical-align: middle;
    }
    .btn-custom {
      background-color: #563d7c;
      color: white;
    }
    .btn-custom:hover {
      background-color: #6f5499;
    }
  </style>
</head>

<body>

  <div class="container">
    <h1>Lista de clientes de la librería</h1>

    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Acciones</th>
        </tr>
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
                    <td>
                      <form method='POST' class='d-inline'>
                        <input type='hidden' name='id_cliente' value='{$row['id_cliente']}'>
                        <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                      </form>
                      <form method='GET' action='actualizar_cliente.php' class='d-inline'>
                        <input type='hidden' name='id_cliente' value='{$row['id_cliente']}'>
                        <button type='submit' class='btn btn-warning btn-sm'>Actualizar</button>
                      </form>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='4' class='text-center'>No hay clientes</td></tr>";
        }
        ConexionDb::conexion_db()->close();
        ?>
      </tbody>
    </table>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
