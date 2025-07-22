<?php
/**
 * Función para generar una contraseña segura.
 *
 * @param int  $length          La longitud deseada de la contraseña.
 * @param bool $includeNumbers  Si se deben incluir números.
 * @param bool $includeSymbols  Si se deben incluir símbolos.
 * @param bool $includeUppercase Si se deben incluir letras mayúsculas.
 * @param bool $includeLowercase Si se deben incluir letras minúsculas.
 * @return string La contraseña segura generada.
 */
function generateSecurePassword($length = 12, $includeNumbers = true, $includeSymbols = true, $includeUppercase = true, $includeLowercase = true) {
    $chars = '';
    $password = '';

    // Define los conjuntos de caracteres
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*()-_+=[]{}|;:,.<>?';

    // Construye el conjunto de caracteres disponibles según las opciones
    if ($includeLowercase) {
        $chars .= $lowercase;
    }
    if ($includeUppercase) {
        $chars .= $uppercase;
    }
    if ($includeNumbers) {
        $chars .= $numbers;
    }
    if ($includeSymbols) {
        $chars .= $symbols;
    }

    // Si no se selecciona ningún tipo de carácter, se usa un conjunto por defecto
    if (empty($chars)) {
        // Por seguridad, siempre incluimos al menos minúsculas, mayúsculas y números si no se selecciona nada.
        $chars = $lowercase . $uppercase . $numbers;
    }

    // Asegura que al menos un carácter de cada tipo seleccionado esté presente
    // Esto es para garantizar que las contraseñas cumplan con los criterios mínimos
    if ($includeLowercase && !preg_match('/[a-z]/', $password)) {
        $password .= $lowercase[array_rand(str_split($lowercase))];
    }
    if ($includeUppercase && !preg_match('/[A-Z]/', $password)) {
        $password .= $uppercase[array_rand(str_split($uppercase))];
    }
    if ($includeNumbers && !preg_match('/[0-9]/', $password)) {
        $password .= $numbers[array_rand(str_split($numbers))];
    }
    if ($includeSymbols && !preg_match('/[!@#$%^&*()\-_+=[]{}\|;:,.<>\?]/', $password)) {
        $password .= $symbols[array_rand(str_split($symbols))];
    }

    // Completa la contraseña con caracteres aleatorios del conjunto combinado
    $remainingLength = $length - strlen($password);
    for ($i = 0; $i < $remainingLength; $i++) {
        $password .= $chars[mt_rand(0, strlen($chars) - 1)];
    }

    // Mezcla la contraseña para asegurar la aleatoriedad de la posición de los caracteres
    return str_shuffle($password);
}

// Valores por defecto y procesamiento del formulario
$password = '';
$length = isset($_POST['length']) ? (int)$_POST['length'] : 12;
$includeNumbers = isset($_POST['include_numbers']);
$includeSymbols = isset($_POST['include_symbols']);
$includeUppercase = isset($_POST['include_uppercase']);
$includeLowercase = isset($_POST['include_lowercase']);

// Generar contraseña si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = generateSecurePassword(
        $length,
        $includeNumbers,
        $includeSymbols,
        $includeUppercase,
        $includeLowercase
    );
} else {
    // Generar una contraseña inicial al cargar la página por primera vez
    $password = generateSecurePassword();
    $includeNumbers = true;
    $includeSymbols = true;
    $includeUppercase = true;
    $includeLowercase = true;
}
?>