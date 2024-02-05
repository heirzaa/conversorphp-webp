<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de imágenes a WebP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="row">
        <div class="col">
            <!-- Formulario base, recibe imagen y la manda al controlador -->
            <form action="controller.php" method="post" enctype="multipart/form-data">
                <!-- llama al controlador php que se encuentra junto al index -->
                <label for="imagenes">Utilidad para adjuntar archivos y transformar a WebP, utiliza GD2</label>
        </div>
        <div class="col">
            <input type="file" class="form-control" name="imagenes[]" multiple accept="image/png, image/jpeg, image/jpg, image/gif">
            <br>
            <input type="submit" value="Subir imágenes">
            </form>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>
