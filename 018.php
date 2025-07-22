<?php

/**
 * Esta función simula una operación que puede fallar.
 * Lanza una excepción si el valor de entrada es negativo o cero.
 *
 * @param int $numero El número a procesar.
 * @return string Un mensaje de éxito si el número es positivo.
 * @throws Exception Si el número es menor o igual a cero.
 */
function procesarNumero(int $numero): string {
    // Aquí es donde lanzamos (throw) una excepción si se da una condición de error.
    // Las excepciones son objetos que representan una situación excepcional (un error).
    if ($numero <= 0) {
        // Creamos una nueva instancia de la clase Exception.
        // El primer argumento es el mensaje de la excepción.
        // El segundo argumento opcional es un código de error.
        throw new Exception("El número debe ser positivo y mayor que cero.", 1001);
    }

    // Si llegamos aquí, significa que la operación fue exitosa.
    return "Número procesado con éxito: " . $numero;
}

// --- Estructura básica de una página web con manejo de excepciones ---

// 1. Inicio de la estructura HTML
echo "<!DOCTYPE html>";
echo "<html lang='es'>";
echo "<head>";
echo "    <meta charset='UTF-8'>";
echo "    <meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "    <title>Manejo de Excepciones PHP</title>";
echo "    <style>";
echo "        body { font-family: sans-serif; margin: 20px; }";
echo "        .success { color: green; border: 1px solid green; padding: 10px; margin-bottom: 10px; }";
echo "        .error { color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px; }";
echo "        h1 { color: #333; }";
echo "        p { margin-bottom: 5px; }";
echo "    </style>";
echo "</head>";
echo "<body>";
echo "    <h1>Ejemplo de Manejo de Excepciones en PHP</h1>";

// 2. Bloque try-catch para manejar excepciones

// El bloque 'try' contiene el código que podría lanzar una excepción.
// Es la sección que intentamos ejecutar.
try {
    // Ejemplo 1: Llamada a la función con un valor válido (no debería lanzar excepción).
    $resultado1 = procesarNumero(5);
    echo "<div class='success'>";
    echo "    <h2>Caso 1: Entrada Válida</h2>";
    echo "    <p>" . htmlspecialchars($resultado1) . "</p>"; // htmlspecialchars para prevenir XSS
    echo "</div>";

    // Ejemplo 2: Llamada a la función con un valor inválido (debería lanzar excepción).
    // Esta línea lanzará una excepción y el flujo de ejecución saltará al bloque 'catch'.
    $resultado2 = procesarNumero(0);
    echo "<div class='success'>"; // Esta línea no se ejecutará si se lanza la excepción
    echo "    <p>" . htmlspecialchars($resultado2) . "</p>";
    echo "</div>";

} catch (Exception $e) {
    // El bloque 'catch' se ejecuta si se lanza una excepción dentro del bloque 'try'.
    // '$e' es una variable que contendrá el objeto Exception lanzado.
    echo "<div class='error'>";
    echo "    <h2>¡Ocurrió un Error!</h2>";
    // Obtenemos el mensaje de la excepción usando $e->getMessage().
    echo "    <p><strong>Mensaje:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    // Obtenemos el código de la excepción usando $e->getCode().
    echo "    <p><strong>Código de error:</strong> " . htmlspecialchars($e->getCode()) . "</p>";
    // Podemos obtener el archivo donde ocurrió la excepción con $e->getFile().
    echo "    <p><strong>Archivo:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
    // Y la línea exacta con $e->getLine().
    echo "    <p><strong>Línea:</strong> " . htmlspecialchars($e->getLine()) . "</p>";
    // Para depuración, $e->getTraceAsString() muestra el stack trace completo.
    // En un entorno de producción, es mejor registrar esto en un log y no mostrarlo al usuario.
    // echo "<p><strong>Rastreo:</strong> <pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre></p>";
    echo "</div>";
} finally {
    // El bloque 'finally' es opcional y siempre se ejecuta, independientemente
    // de si se lanzó una excepción o no en el bloque 'try'.
    // Es útil para liberar recursos (cerrar conexiones a bases de datos, archivos, etc.).
    echo "<div style='background-color: #f0f0f0; padding: 10px; border-radius: 5px;'>";
    echo "    <p>Esto se ejecuta siempre, ya sea que haya un error o no (bloque 'finally').</p>";
    echo "</div>";
}

// 3. Otro ejemplo de uso de excepciones con try-catch anidados o específicos
echo "<h2>Manejo de Excepciones con tipos específicos</h2>";

// Podemos definir clases de excepción personalizadas para errores más específicos.
class ValidacionException extends Exception {
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function obtenerMensajeValidacion(): string {
        return "Error de validación: " . $this->getMessage();
    }
}

function verificarEmail(string $email): string {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Lanzamos nuestra excepción personalizada
        throw new ValidacionException("Formato de correo electrónico inválido.", 2001);
    }
    return "Correo electrónico válido: " . $email;
}

try {
    echo "<div class='success'>";
    echo "    <h3>Intento de Email Válido</h3>";
    echo "    <p>" . htmlspecialchars(verificarEmail("ejemplo@dominio.com")) . "</p>";
    echo "</div>";

    echo "<div class='success'>";
    echo "    <h3>Intento de Email Inválido</h3>";
    // Esta llamada lanzará una ValidacionException
    echo "    <p>" . htmlspecialchars(verificarEmail("correo-invalido")) . "</p>";
    echo "</div>";

} catch (ValidacionException $e) {
    // Capturamos específicamente nuestra excepción personalizada
    echo "<div class='error'>";
    echo "    <p>" . htmlspecialchars($e->obtenerMensajeValidacion()) . "</p>";
    echo "    <p>Código: " . htmlspecialchars($e->getCode()) . "</p>";
    echo "</div>";
} catch (Exception $e) {
    // Si no fuera una ValidacionException, caería en el catch genérico de Exception
    echo "<div class='error'>";
    echo "    <p>Otro tipo de error inesperado: " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "</div>";
}

// 4. Fin de la estructura HTML
echo "</body>";
echo "</html>";

?>