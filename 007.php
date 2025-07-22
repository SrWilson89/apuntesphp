<?php
// Siempre iniciar la sesión al principio si vas a usar $_SESSION
session_start();

// --- 1. Demostración de $_COOKIE ---
// Establecer una cookie. Las cookies se envían con las cabeceras HTTP,
// así que deben establecerse antes de cualquier salida HTML.
if (!isset($_COOKIE['mi_ejemplo_cookie'])) {
    setcookie('mi_ejemplo_cookie', 'Valor de prueba de cookie', time() + (86400 * 30), "/"); // Cookie válida por 30 días
    $cookie_set_message = "Cookie 'mi_ejemplo_cookie' establecida. Recarga la página para verla.";
} else {
    $cookie_set_message = "Cookie 'mi_ejemplo_cookie' ya existe o se ha establecido.";
}

// --- 2. Demostración de $_SESSION ---
// Establecer una variable de sesión
if (!isset($_SESSION['contador_visitas'])) {
    $_SESSION['contador_visitas'] = 1;
} else {
    $_SESSION['contador_visitas']++;
}

// --- 3. Demostración de $_POST y $_FILES ---
$post_message = '';
$file_upload_info = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejar datos POST
    if (!empty($_POST)) {
        $post_message = "¡Datos POST recibidos!";
    }

    // Manejar subida de archivos
    if (isset($_FILES['archivo_subido']) && $_FILES['archivo_subido']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Asegúrate de que esta carpeta exista y tenga permisos de escritura
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $upload_file = $upload_dir . basename($_FILES['archivo_subido']['name']);

        if (move_uploaded_file($_FILES['archivo_subido']['tmp_name'], $upload_file)) {
            $file_upload_info = "Archivo subido exitosamente: " . htmlspecialchars(basename($_FILES['archivo_subido']['name']));
        } else {
            $file_upload_info = "Error al subir el archivo.";
        }
    } else if (isset($_FILES['archivo_subido']) && $_FILES['archivo_subido']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file_upload_info = "Error de subida: " . $_FILES['archivo_subido']['error'];
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demostración de Superglobales PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 900px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #0056b3; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 30px; }
        pre { background-color: #e9e9e9; padding: 15px; border-radius: 5px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; }
        .info-box { background-color: #d1ecf1; color: #0c5460; border: 1px solid #bee5eb; border-radius: 5px; padding: 10px; margin-bottom: 15px; }
        form { background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ddd; }
        input[type="text"], input[type="email"], input[type="file"] { width: calc(100% - 22px); padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        input[type="submit"]:hover { background-color: #218838; }
        .link-button { display: inline-block; background-color: #007bff; color: white; padding: 8px 12px; border-radius: 4px; text-decoration: none; margin-right: 10px; }
        .link-button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Demostración de Variables Superglobales en PHP</h1>

        <div class="info-box">
            <p><strong>Recarga la página</strong> varias veces para ver cómo cambia el `$_SESSION['contador_visitas']` y cómo se mantiene la `$_COOKIE`.</p>
            <p><?php echo $cookie_set_message; ?></p>
        </div>

        <h2>$_SESSION (Variables de Sesión)</h2>
        <p>Estas variables persisten entre diferentes solicitudes durante la misma sesión de usuario.</p>
        <pre><?php print_r($_SESSION); ?></pre>

        <h2>$_COOKIE (Cookies)</h2>
        <p>Contiene datos enviados al script a través de cabeceras HTTP de cookies.</p>
        <pre><?php print_r($_COOKIE); ?></pre>

        <h2>$_SERVER (Información del Servidor y Entorno de Ejecución)</h2>
        <p>Contiene información sobre el servidor, las cabeceras y las rutas del script.</p>
        <pre><?php print_r($_SERVER); ?></pre>

        <h2>$_GET (Parámetros de URL)</h2>
        <p>Contiene todos los parámetros enviados a través de la URL (query string).</p>
        <p>Haz clic para añadir parámetros GET:</p>
        <a href="?nombre=Juan&edad=30" class="link-button">Añadir GET simple</a>
        <a href="?ciudad=Barcelona&pais=España&idioma=es" class="link-button">Añadir GET con múltiples</a>
        <pre><?php print_r($_GET); ?></pre>

        <h2>$_POST (Datos de Formulario POST) y $_FILES (Archivos Subidos)</h2>
        <p>
            `$_POST` contiene datos enviados mediante el método POST de un formulario.
            `$_FILES` contiene información sobre archivos subidos a través de un formulario con `enctype="multipart/form-data"`.
        </p>
        <form method="POST" action="superglobals.php" enctype="multipart/form-data">
            <h3>Enviar datos POST y archivo:</h3>
            <label for="nombre_post">Nombre:</label><br>
            <input type="text" id="nombre_post" name="nombre_post" value="Ejemplo Nombre"><br><br>

            <label for="email_post">Email:</label><br>
            <input type="email" id="email_post" name="email_post" value="ejemplo@correo.com"><br><br>

            <label for="archivo_subido">Seleccionar archivo para subir:</label><br>
            <input type="file" id="archivo_subido" name="archivo_subido"><br><br>

            <input type="submit" value="Enviar por POST">
        </form>
        <?php if ($post_message): ?>
            <div class="info-box"><?php echo $post_message; ?></div>
            <h3>Contenido de $_POST:</h3>
            <pre><?php print_r($_POST); ?></pre>
        <?php endif; ?>
        <?php if ($file_upload_info): ?>
            <div class="info-box"><?php echo $file_upload_info; ?></div>
            <h3>Contenido de $_FILES:</h3>
            <pre><?php print_r($_FILES); ?></pre>
        <?php endif; ?>


        <h2>$_REQUEST (GET, POST y COOKIE Combinados)</h2>
        <p>
            Contiene datos de `$_GET`, `$_POST` y `$_COOKIE` por defecto. El orden de precedencia (cuál sobreescribe a cuál si hay claves con el mismo nombre) se controla por la directiva `variables_order` en `php.ini`. Normalmente es `GPC` (GET, POST, Cookie), lo que significa que POST sobreescribe a GET y Cookie sobreescribe a POST.
        </p>
        <pre><?php print_r($_REQUEST); ?></pre>

        <h2>$_ENV (Variables de Entorno del Sistema)</h2>
        <p>Contiene variables de entorno pasadas al script por el sistema operativo en el que se ejecuta el servidor web.</p>
        <p class="info-box">Nota: Esta superglobal puede estar vacía o contener pocas variables dependiendo de la configuración de tu servidor web (e.g., Apache/Nginx y PHP-FPM).</p>
        <pre><?php print_r($_ENV); ?></pre>

        <h2>$GLOBALS (Todas las Variables Globales Disponibles)</h2>
        <p>
            Un array asociativo que contiene referencias a todas las variables que están actualmente definidas en el ámbito global del script. Cada superglobal (como `$_SERVER`, `$_GET`, etc.) es accesible también a través de `$GLOBALS`.
        </p>
        <p class="info-box">Nota: Este array es muy grande ya que contiene *todas* las variables globales, incluyendo las otras superglobales. Se muestra solo una parte por brevedad.</p>
        <pre><?php
            // Para no imprimir todo $GLOBALS, que es enorme, mostramos solo algunos ejemplos.
            echo "Ejemplo de \$GLOBALS['$_SERVER']:\n";
            print_r($GLOBALS['_SERVER']);
            echo "\nEjemplo de \$GLOBALS['$_GET']:\n";
            print_r($GLOBALS['_GET']);
            echo "\nEjemplo de \$GLOBALS['$_SESSION']:\n";
            print_r($GLOBALS['_SESSION']);
            // print_r($GLOBALS); // Descomenta esta línea para ver el array $GLOBALS completo (puede ser muy largo)
        ?></pre>

    </div>

</body>
</html>