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
    <title>Document</title>
</head>
<body>
    <form action="registrar_libro.php" method="post">

        <label>Titulo: </label>
        <input type="text" id="titulo" name="titulo" required>
        <br><br>
        <label>Author: </label>
        <input type="text" id="author" name="author" required>
        <br><br>

        <label>ISBN: </label>
        <input type="number" id="isbn" name="isbn" required>
        <br><br>


        <label>Numero de edicion: </label>
        <input type="number" id="numero_edicion" step="0.01" name="numero_edicion" required>
        <br><br>

        <label>Costo diario: </label>
        <input type="number" id="costo_diario" name="costo_diario" required>
        <br><br>

        <input type="submit" value="Registrar">

    </form>
    <br><br>
    <a href="lista_libros.php">Lista de libros</a>
</body>
</html>