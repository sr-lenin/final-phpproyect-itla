<?php
include "./conexion_db.php";

$conexion = ConexionDb::conexion_db();
$sql_prestamos = "SELECT P.id_prestamo, L.titulo 
                  FROM prestamos AS P
                  JOIN libros AS L ON P.id_libro = L.id_libro
                  WHERE L.estado = 'prestado'
                  AND P.estado_prestamo = 'activo'";
$result_prestamos = $conexion->query($sql_prestamos);
?>

<form action="proceso_devolver_libro.php" method="POST">
  <label for="id_prestamo">Préstamo:</label>
  <select id="id_prestamo" name="id_prestamo" required>
    <option value="">Seleccione un préstamo</option>
    <?php
    if ($result_prestamos->num_rows > 0) {
        while($row_prestamo = $result_prestamos->fetch_assoc()) {
            echo "<option value='" . $row_prestamo['id_prestamo'] . "'>" . $row_prestamo['titulo'] . "</option>";
        }
    } else {
        echo "<option value=''>No hay préstamos activos</option>";
    }
    ?>
  </select><br>

  <input type="submit" value="Devolver Libro">
</form>

<?php
$conexion->close();
?>
