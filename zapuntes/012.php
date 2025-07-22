<!DOCTYPE html>
<html>
<head>
    <title>Subir Archivo</title>
</head>
<body>

<?php
// Directorio de destino para los archivos subidos
$target_dir = "uploads/";
// Inicializar variables para evitar advertencias si no se envía el formulario
$uploadOk = 1;
$message = ""; // Variable para almacenar mensajes al usuario

// Solo procesar si el formulario ha sido enviado
if (isset($_POST["submit"])) {
    // Verificar si se ha seleccionado un archivo
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Comprobar si el archivo es una imagen real o una falsa
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $message .= "El archivo es una imagen - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            $message .= "El archivo no es una imagen.<br>";
            $uploadOk = 0;
        }

        // Comprobar si el archivo ya existe
        if (file_exists($target_file)) {
            $message .= "Lo siento, el archivo ya existe.<br>";
            $uploadOk = 0;
        }

        // Comprobar el tamaño del archivo (500 KB)
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $message .= "Lo siento, tu archivo es demasiado grande.<br>";
            $uploadOk = 0;
        }

        // Permitir solo ciertos formatos de archivo
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $message .= "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.<br>";
            $uploadOk = 0;
        }

        // Comprobar si $uploadOk se ha establecido en 0 por un error
        if ($uploadOk == 0) {
            $message .= "Lo siento, tu archivo no fue subido.<br>";
        } else {
            // Si todo está bien, intentar subir el archivo
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $message .= "El archivo ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " ha sido subido.<br>";
            } else {
                $message .= "Lo siento, hubo un error al subir tu archivo.<br>";
            }
        }
    } else {
        // Manejar errores si no se seleccionó un archivo o hubo un error de subida
        if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] != UPLOAD_ERR_NO_FILE) {
            $message .= "Error en la subida del archivo (código: " . $_FILES["fileToUpload"]["error"] . ").<br>";
        } else {
            // Este mensaje aparecerá la primera vez que se carga la página o si no se selecciona ningún archivo
            $message .= "Por favor, selecciona un archivo para subir.<br>";
        }
        $uploadOk = 0; // Asegurarse de que no se intente una subida si no hay archivo o hay error
    }
}
?>

<h2>Subir Imagen</h2>

<?php
// Mostrar mensajes al usuario
if (!empty($message)) {
    echo "<p>$message</p>";
}
?>

<form action="012.php" method="post" enctype="multipart/form-data">
  Selecciona una imagen para subir:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br><br>
  <input type="submit" value="Subir Imagen" name="submit">
</form>

</body>
</html>