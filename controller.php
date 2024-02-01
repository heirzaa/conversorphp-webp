<?php

// Función principal
function convertImageToWebP($source, $destination, $quality = 80)
{
    // Guarda la extensión del archivo que entró en una variable
    $extensionArchivo = pathinfo($source, PATHINFO_EXTENSION);

    // Recorre lo que rescató variable extensionArchivo
    switch ($extensionArchivo) {
        case 'jpeg':
        case 'jpg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'gif':
            $image = imagecreatefromgif($source);
            // CREA una imagen TEMPORAL a partir de un archivo gif
            $rutaTemporal = 'uploads/' . uniqid() . '.png';
            imagepng($image, $rutaTemporal);
            imagedestroy($image);
            // La guarda antes de destruirla
            $image = imagecreatefrompng($rutaTemporal);
            // DESDE la imagen png creada hace la conversion a gif
            unlink($rutaTemporal);
            // Tanto gif como png necesitan un truecolor antes de convertirse.
            imagepalettetotruecolor($image);
            break;
        case 'png':
            $image = imagecreatefrompng($source);
            imagepalettetotruecolor($image);
            break;
        default:
            unlink($source);
            return false;
            // Tipo de archivo no permitido
    }

    $success = imagewebp($image, $destination, $quality);
    imagedestroy($image); // Destruir la imagen después de la conversión
    return $success;
}

// Verifica si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Condicional: si se envió una imagen desde el formulario, continúa la ejecución
    if (isset($_FILES['imagen']) && strpos($_FILES['imagen']['type'], 'image/') === 0) {
        $archivoEntrante = $_FILES['imagen'];
// Guarda el archivo entrante en variable
        // Define el directorio para archivos temporales
        $directorioTemporal = 'salientes/';

        // Captura la ruta específica del archivo que entró
        $rutaArchivoTemporal = $directorioTemporal . basename($archivoEntrante['name']);

        if (move_uploaded_file($archivoEntrante['tmp_name'], $rutaArchivoTemporal)) {
            // Esta linea establece que el archivo que sale, se llamará igual que el que entró con extension webp y se guardará en carpeta temporal de salientes en directorio
            $rutaArchivoSaliente = 'salientes/' . pathinfo($archivoEntrante['name'], PATHINFO_FILENAME) . '.webp';
            if (convertImageToWebP($rutaArchivoTemporal, $rutaArchivoSaliente)) {
                // Enviar el archivo WebP al navegador para su descarga
                header('Content-Type: image/webp');
                header('Content-Disposition: attachment; filename="' . basename($rutaArchivoSaliente) . '"');
                readfile($rutaArchivoSaliente);

                // Se elimina el resultado tras descarga
                unlink($rutaArchivoSaliente);

                // e igualmente, el archivo que entra
                unlink($rutaArchivoTemporal);

                echo '¡Conversión realizada exitosamente!';
            } else {
                echo 'Error durante el proceso de conversión. ';
            }
        } else {
            echo 'Error al subir la imagen. Archivo de entrada no eliminado.';
        }
    } else {
        echo 'Intentaste subir una canción? >:(';
    }
}
?>

