<?php
include "./class_libreria.php";
$pretamoInfo = new Prestamo();
$result_clientes = $pretamoInfo->getClientes();
$result_libros = $pretamoInfo->getLibros();
?>

<form action="procesar_prestamo.php" method="POST">
  <label for="id_cliente">Cliente:</label>
  <select id="id_cliente" name="id_cliente" required>
    <option value="">Seleccione un cliente</option>
    <?php
    if ($result_clientes->num_rows > 0) {
        while($row_cliente = $result_clientes->fetch_assoc()) {
            echo "<option value='" . $row_cliente['id_cliente'] . "'>" . "id: ". $row_cliente['id_cliente'] . " ". "nombre: ".  $row_cliente['nombre'] ."</option>";
        }
    } else {
        echo "<option value=''>No hay clientes disponibles</option>";
    }
    ?>
  </select><br>

  <label for="id_libro">Libro:</label>
  <select id="id_libro" name="id_libro" required>
    <option value="">Seleccione un libro</option>
    <?php
    if ($result_libros->num_rows > 0) {
        while($row_libro = $result_libros->fetch_assoc()) {
            echo "<option value='" . $row_libro['id_libro'] . "'>" . $row_libro['titulo'] . "</option>";
        }
    } else {
        echo "<option value=''>No hay libros disponibles</option>";
    }
    ?>
  </select><br>

  <label for="fecha_inicio">Fecha de Inicio:</label>
  <input type="date" id="fecha_inicio" name="fecha_inicio" required><br>

  <label for="fecha_final">Fecha de Final:</label>
  <input type="date" id="fecha_final" name="fecha_final" required><br>

  <input type="submit" value="Agregar Préstamo">
</form>
<br><br>
<a href="lista_clientes_libreria.php">Lista de clientes</a>

