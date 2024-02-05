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
    if (isset($_FILES['imagenes'])) {
        $imagenesEntrantes = $_FILES['imagenes'];
        
        // Define el directorio para archivos temporales
        $directorioTemporal = 'salientes/';

        $rutasImagenesSalientes = array();

        foreach ($imagenesEntrantes['tmp_name'] as $index => $imagenTemporal) {
            $nombreOriginal = $imagenesEntrantes['name'][$index];
            $rutaImagenTemporal = $directorioTemporal . basename($nombreOriginal);

            if (move_uploaded_file($imagenTemporal, $rutaImagenTemporal)) {
                $rutaImagenSaliente = 'salientes/' . pathinfo($nombreOriginal, PATHINFO_FILENAME) . '.webp';

                if (convertImageToWebP($rutaImagenTemporal, $rutaImagenSaliente)) {
                    $rutasImagenesSalientes[] = $rutaImagenSaliente;
                } else {
                    echo 'Error durante el proceso de conversión para ' . $nombreOriginal . '. ';
                }

                // Elimina el archivo temporal después de procesarlo
                unlink($rutaImagenTemporal);
            } else {
                echo 'Error al subir la imagen ' . $nombreOriginal . '. Archivo de entrada no eliminado.';
            }
        }

        if (!empty($rutasImagenesSalientes)) {
            // Comprime las imágenes en un archivo ZIP
            $nombreZip = 'imagenes_convertidas.zip';
            $rutaZip = $directorioTemporal . $nombreZip;
            $zip = new ZipArchive();
            
            if ($zip->open($rutaZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
                foreach ($rutasImagenesSalientes as $rutaImagenSaliente) {
                    $archivoZip = pathinfo($rutaImagenSaliente, PATHINFO_BASENAME);
                    $zip->addFile($rutaImagenSaliente, $archivoZip);
                }
                $zip->close();

                // Envía el archivo ZIP al navegador
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . $nombreZip . '"');
                readfile($rutaZip);

                // Elimina el archivo ZIP y las imágenes después de la descarga
                unlink($rutaZip);
                foreach ($rutasImagenesSalientes as $rutaImagenSaliente) {
                    unlink($rutaImagenSaliente);
                }

                echo '¡Conversión realizada exitosamente para todas las imágenes!';
            } else {
                echo 'Error al crear el archivo ZIP.';
            }
        } else {
            echo 'No se pudieron convertir las imágenes.';
        }
    } else {
        echo 'No se recibieron imágenes.';
    }
} else {
    echo 'Acceso no autorizado.';
}
?>