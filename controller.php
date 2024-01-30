<?php

function convertImageToWebP($source, $destination, $quality=80) {  	
$extension = pathinfo($source, PATHINFO_EXTENSION);  	
if ($extension == 'jpeg' || $extension == 'jpg')   		
$image = imagecreatefromjpeg($source);  	
elseif ($extension == 'gif')   		
$image = imagecreatefromgif($source);  	
elseif ($extension == 'png')   		
$image = imagecreatefrompng($source);  	
return imagewebp($image, $destination, $quality);  	  
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se ha subido un archivo
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['imagen'];

        // Verificar el tipo de archivo (png, jpeg, jpg, gif)
        $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/gif'];
        if (in_array($file['type'], $allowedTypes)) {
            // Mover el archivo a una ubicación deseada
            $uploadDir = 'uploads/'; // Puedes ajustar la carpeta de destino
            $uploadPath = $uploadDir . basename($file['name']);

            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                // Convertir la imagen a WebP
                $webpDestination = 'uploads/' . pathinfo($file['name'], PATHINFO_FILENAME) . '.webp';
                convertImageToWebP($uploadPath, $webpDestination);
                

                
                header('Content-Type: image/webp');
                header('Content-Disposition: attachment; filename="' . basename($webpDestination) . '"');
                readfile($webpDestination);
                echo '¡La imagen se ha subido y convertido a WebP correctamente!';
            } else {
                echo 'Error al subir la imagen.';
            }
        } else {
            echo 'Tipo de archivo no permitido. Sube una imagen en formato png, jpeg, jpg o gif.';
        }
    } else {
        echo 'Error al subir la imagen.';
    }
} else {
    // Redirigir o manejar de otra manera si se accede directamente a controller.php
    echo 'Acceso no permitido.';
}
?>
