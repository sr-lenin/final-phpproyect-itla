<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Incluye Bootstrap 4 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Biblioteca</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="lista_clientes_libreria.php">Lista de clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registrar_cliente.php">Registrar nuevo cliente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="lista_libros.php">Lista libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registrar_libro.php">Registrar nuevo libro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="crear_prestamo.php">Alquilar un libro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="devolver_libro.php">Devolver libro</a>
                </li>
            </ul>
        </div>
    </nav>

</body>
</html>
