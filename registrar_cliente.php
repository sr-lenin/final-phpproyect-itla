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
    <title>Registrar Cliente</title>

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
        <h1>Registrar Cliente</h1>

        <form action="registrar_cliente.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="number" class="form-control" id="telefono" name="telefono" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>

        <br>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
