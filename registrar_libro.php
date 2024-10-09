<?php  
include "./class_libreria.php";
?>

<?php  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $libro = new Libro();
    $libro->crearLibro();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Libro</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #007bff;
            margin-bottom: 30px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Registrar Libro</h1>

        <form action="registrar_libro.php" method="post">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="author">Autor:</label>
                <input type="text" class="form-control" id="author" name="author" required>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="number" class="form-control" id="isbn" name="isbn" required>
            </div>

            <div class="form-group">
                <label for="numero_edicion">Número de Edición:</label>
                <input type="number" class="form-control" id="numero_edicion" step="0.01" name="numero_edicion" required>
            </div>

            <div class="form-group">
                <label for="costo_diario">Costo Diario:</label>
                <input type="number" class="form-control" id="costo_diario" name="costo_diario" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <br>
        <a href="lista_libros.php" class="btn btn-link">Lista de libros</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
