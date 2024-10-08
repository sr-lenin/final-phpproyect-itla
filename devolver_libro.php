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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolución de Libro</title>

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
        <h1>Devolver Libro</h1>

        <form action="proceso_devolver_libro.php" method="POST">
            <div class="form-group">
                <label for="id_prestamo">Préstamo:</label>
                <select id="id_prestamo" name="id_prestamo" class="form-control" required>
                    <option value="">Seleccione un préstamo</option>
                    <?php
                    if ($result_prestamos->num_rows > 0) {
                        while ($row_prestamo = $result_prestamos->fetch_assoc()) {
                            echo "<option value='" . $row_prestamo['id_prestamo'] . "'>" . $row_prestamo['titulo'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay préstamos activos</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Devolver Libro</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
$conexion->close();
?>
