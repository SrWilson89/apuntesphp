<?php

// Definir el nombre del archivo de log
define('LOG_FILE', 'app_log.txt');

/**
 * Función para escribir mensajes en el archivo de log.
 *
 * @param string $message El mensaje a registrar.
 * @param string $level El nivel del log (INFO, WARNING, ERROR).
 */
function writeToLog($message, $level = 'INFO') {
    // Obtener la fecha y hora actual
    $timestamp = date('Y-m-d H:i:s');

    // Formatear el mensaje de log
    $logMessage = "[$timestamp] [$level]: $message\n";

    // Abrir el archivo de log en modo de añadir (a)
    // 'a' asegura que el contenido nuevo se añade al final del archivo.
    // Si el archivo no existe, lo creará.
    $fileHandle = fopen(LOG_FILE, 'a');

    // Verificar si el archivo se abrió correctamente
    if ($fileHandle) {
        // Escribir el mensaje en el archivo
        fwrite($fileHandle, $logMessage);

        // Cerrar el archivo
        fclose($fileHandle);
    } else {
        // En caso de que no se pueda abrir/escribir en el archivo de log,
        // puedes imprimir un mensaje de error en la pantalla o registrarlo de otra forma.
        error_log("ERROR: No se pudo escribir en el archivo de log: " . LOG_FILE);
    }
}

// --- Ejemplos de uso ---

// Registrar un mensaje de información
writeToLog("El usuario 'admin' ha iniciado sesión correctamente.");

// Registrar un mensaje de advertencia
writeToLog("Se ha detectado un intento de acceso no autorizado desde IP 192.168.1.10.", "ADVERTENCIA");

// Registrar un mensaje de error
writeToLog("La conexión a la base de datos ha fallado. Código de error: 1045.", "ERROR");

// Otro mensaje de información
writeToLog("Se ha procesado un pedido con ID #12345.");

echo "Mensajes de log escritos en '" . LOG_FILE . "' exitosamente.<br>";
echo "Puedes revisar el contenido del archivo 'app_log.txt'.";

?>