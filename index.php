<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Imagen</title>
</head>
<body>
    <form action="controller.php" method="post" enctype="multipart/form-data">
        <label for="imagen">Seleccionar imagen:</label>
        <input type="file" name="imagen" accept="image/png, image/jpeg, image/jpg, image/gif">
        <br>
        <input type="submit" value="Subir imagen">
    </form>
</body>
</html>
