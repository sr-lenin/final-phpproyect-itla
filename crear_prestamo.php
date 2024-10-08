<?php
include "./class_libreria.php";
$prestamoInfo = new Prestamo();
$result_clientes = $prestamoInfo->getClientes();
$result_libros = $prestamoInfo->getLibros();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Préstamo</title>

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
    </style>
</head>

<body>

    <div class="container">
        <h1>Agregar Préstamo</h1>

        <form action="procesar_prestamo.php" method="POST">
            <div class="form-group">
                <label for="id_cliente">Cliente:</label>
                <select id="id_cliente" name="id_cliente" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    <?php
                    if ($result_clientes->num_rows > 0) {
                        while ($row_cliente = $result_clientes->fetch_assoc()) {
                            echo "<option value='" . $row_cliente['id_cliente'] . "'>id: " . $row_cliente['id_cliente'] . " nombre: " . $row_cliente['nombre'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay clientes disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="id_libro">Libro:</label>
                <select id="id_libro" name="id_libro" class="form-control" required>
                    <option value="">Seleccione un libro</option>
                    <?php
                    if ($result_libros->num_rows > 0) {
                        while ($row_libro = $result_libros->fetch_assoc()) {
                            echo "<option value='" . $row_libro['id_libro'] . "'>" . $row_libro['titulo'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay libros disponibles</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fecha_final">Fecha de Final:</label>
                <input type="date" id="fecha_final" name="fecha_final" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Préstamo</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
