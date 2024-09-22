<?php
include "./conexion_db.php";

?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $id_libro = $_POST['id_libro'];

  $sql = "DELETE from libros WHERE id_libro=($id_libro)";
  if (ConexionDb::conexion_db()->query($sql) == TRUE) {
    echo "Producto $id_libro eliminado con exito";
  } else {
    echo "Error: " . ConexionDb::conexion_db()->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de libros</title>
</head>

<body>

  <h1>Lista de libros</h1>

  <table class="table" border="1">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Titulo</th>
        <th scope="col">Author</th>
        <th scope="col">ISBN</th>
        <th scope="col">Numero de edicion</th>
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
                        <form method='POST'>
                        <input type='hidden' name='id_libro' value='{$row['id_libro']}'>
                        <button type='submit' name='eliminar'>Eliminar</button>
                        </form>
                        <form method='GET' action='actualizar_libro.php'>
                        <input type='hidden' name='id_libro' value='{$row['id_libro']}'>
                        <input type='hidden' name='titulo' value='{$row['titulo']}'>
                        <input type='hidden' name='author' value='{$row['author']}'>
                        <input type='hidden' name='isbn' value='{$row['ISBN']}'>
                        <input type='hidden' name='numero_edicion' value='{$row['numero_edicion']}'>
                        <input type='hidden' name='costo_diario' value='{$row['costo_diario']}'>
                        <button type='submit' name='actualizar'>Actualizar</button>
                        </form>
                        </td>
                    </tr>";
        }
      } else {
        echo "<tr><td colospan='5'>No hay libros</td></tr>";
      }
      ConexionDb::conexion_db()->close();
      ?>

    </tbody>
  </table>
  <br><br>
  <a href="registrar_libro.php">Registrar nuevo libro</a>
</body>
</html>
<?php
?>