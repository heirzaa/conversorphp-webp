<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de imágenes a WebP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Agregar Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-/5ahN5Fc9Nu1krP3fENF9bb5uKq9LhJKpveL9Pm8E+KlnKgi9o19HIgFUs6+Io9E3EniAefpVB0VRpK03aFv7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Formulario base, recibe imagen y la manda al controlador -->
                <form action="controller.php" method="post" enctype="multipart/form-data" class="card p-3 fade show">
                    <!-- llama al controlador php que se encuentra junto al index -->
                    <h3 class="text-center mb-3 fw-bold">Conversor de imágenes a WebP</h3>

                    <div class="mb-3">
                        <label for="imagenes" class="form-label"><i class="fas fa-file-image"></i> Selecciona imágenes:</label>
                        <input type="file" class="form-control" name="imagenes[]" multiple accept="image/png, image/jpeg, image/jpg, image/gif">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Subir imágenes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Agregar el script de Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha512-EFA+0g/6N1rjB2Y5VxaOu3NHjY7TE3rnq20pE6JXpgK2P52nxDkiUUTEGuFQssB+KmXsDNO1Jc/21YJfVJ2q1w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

