<?php

// Sección 1: Validación de IPv6
echo "<h2>1. Validación de dirección IPv6:</h2>";
echo "Comprobando si '2001:0db8:85a3:08d3:1319:8a2e:0370:7334' es una dirección IPv6 válida." . "<br>";

$ip = "2001:0db8:85a3:08d3:1319:8a2e:0370:7334";

if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
    echo("$ip es una dirección IPv6 válida") . "<br>";
} else {
    echo("$ip NO es una dirección IPv6 válida") . "<br>";
}
?>

<hr>

<?php
// Sección 2: Validación de URL con query string
echo "<h2>2. Validación de URL con Query String:</h2>";
echo "Comprobando si 'https://www.w3schools.com' es una URL válida con un query string requerido." . "<br>";

$url = "https://www.w3schools.com";

if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED) === false) {
    echo("$url es una URL válida con un query string") . "<br>";
} else {
    echo("$url NO es una URL válida con un query string (ya que no tiene query string)") . "<br>";
}
?>

<hr>

<?php
// Sección 3: Saneamiento de string
echo "<h2>3. Saneamiento de String:</h2>";
echo "Limpiando el string '<h1>Hello WorldÆØÅ!</h1>' de etiquetas HTML y caracteres ASCII altos." . "<br>";

$str = "<h1>Hello WorldÆØÅ!</h1>";

// FILTER_SANITIZE_STRING está obsoleto en PHP 8.1 y se ha eliminado en PHP 9.0.
// Para propósitos de demostración, se mantiene aquí, pero se recomienda htmlspecialchars() o strip_tags().
// FILTER_FLAG_STRIP_HIGH también puede comportarse de manera diferente según la codificación.
$newstr = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
echo "String original: " . htmlspecialchars($str) . "<br>"; // Usar htmlspecialchars para mostrar el original con etiquetas
echo "String saneado (sin HTML ni caracteres ASCII altos): " . $newstr . "<br>";
?>

<hr>

<?php
// Definición de funciones para validación de IP y Email
echo "<h2>4. Funciones de Validación (IP y Email):</h2>";

/**
 * Valida si una cadena es una dirección IP válida (IPv4 o IPv6).
 *
 * @param string $ip_address La dirección IP a validar.
 * @return string Mensaje indicando si la IP es válida o no.
 */
function validarIp(string $ip_address): string {
    if (filter_var($ip_address, FILTER_VALIDATE_IP)) {
        return "$ip_address es una dirección IP válida (IPv4 o IPv6).";
    } else {
        return "$ip_address NO es una dirección IP válida.";
    }
}

/**
 * Valida si una cadena es una dirección de correo electrónico válida.
 *
 * @param string $email_address La dirección de correo a validar.
 * @return string Mensaje indicando si el email es válido o no.
 */
function validarEmail(string $email_address): string {
    if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        return "$email_address es una dirección de correo electrónico válida.";
    } else {
        return "$email_address NO es una dirección de correo electrónico válida.";
    }
}

// Llamadas a las funciones
echo "<h4>Llamando a la función validarIp():</h4>";
echo "Probando con '192.168.1.1': " . validarIp("192.168.1.1") . "<br>";
echo "Probando con '2001:db8::1': " . validarIp("2001:db8::1") . "<br>";
echo "Probando con '256.256.256.256': " . validarIp("256.256.256.256") . "<br>";
echo "Probando con 'esto_no_es_una_ip': " . validarIp("esto_no_es_una_ip") . "<br>";

echo "<h4>Llamando a la función validarEmail():</h4>";
echo "Probando con 'test@example.com': " . validarEmail("test@example.com") . "<br>";
echo "Probando con 'invalid-email': " . validarEmail("invalid-email") . "<br>";
echo "Probando con 'user@sub.domain.co.uk': " . validarEmail("user@sub.domain.co.uk") . "<br>";

?>