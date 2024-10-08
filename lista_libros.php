<?php
include "./conexion_db.php";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_libro = $_POST['id_libro'];

  $sql = "DELETE from libros WHERE id_libro=($id_libro)";
  if (ConexionDb::conexion_db()->query($sql) == TRUE) {
    echo "<div class='alert alert-success'>Producto $id_libro eliminado con éxito</div>";
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
  <title>Lista de libros</title>

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
    <h1>Lista de libros</h1>

    <table class="table table-bordered table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Título</th>
          <th scope="col">Autor</th>
          <th scope="col">ISBN</th>
          <th scope="col">Número de edición</th>
          <th scope="col">Costo diario</th>
          <th scope="col">Estado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM libros";
        $result = ConexionDb::conexion_db()->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <th scope='row'>{$row['id_libro']}</th>
                    <td>{$row['titulo']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['ISBN']}</td>
                    <td>{$row['numero_edicion']}</td>
                    <td>{$row['costo_diario']}</td>
                    <td>{$row['estado']}</td>
                    <td>
                      <form method='POST' class='d-inline'>
                        <input type='hidden' name='id_libro' value='{$row['id_libro']}'>
                        <button type='submit' class='btn btn-danger btn-sm'>Eliminar</button>
                      </form>
                      <form method='GET' action='actualizar_libro.php' class='d-inline'>
                        <input type='hidden' name='id_libro' value='{$row['id_libro']}'>
                        <input type='hidden' name='titulo' value='{$row['titulo']}'>
                        <input type='hidden' name='author' value='{$row['author']}'>
                        <input type='hidden' name='isbn' value='{$row['ISBN']}'>
                        <input type='hidden' name='numero_edicion' value='{$row['numero_edicion']}'>
                        <input type='hidden' name='costo_diario' value='{$row['costo_diario']}'>
                        <button type='submit' class='btn btn-warning btn-sm'>Actualizar</button>
                      </form>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='8' class='text-center'>No hay libros</td></tr>";
        }
        ConexionDb::conexion_db()->close();
        ?>
      </tbody>
    </table>

    <a href="registrar_libro.php" class="btn btn-custom">Registrar nuevo libro</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
