<?php
// Función para generar una contraseña segura
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

// Valores por defecto
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Contraseñas Seguras</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Generador de Contraseñas Seguras</h1>
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="length">Longitud:</label>
                <input type="number" id="length" name="length" min="6" max="32" value="<?php echo htmlspecialchars($length); ?>">
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="include_uppercase" name="include_uppercase" <?php echo $includeUppercase ? 'checked' : ''; ?>>
                <label for="include_uppercase">Incluir Mayúsculas (A-Z)</label>
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="include_lowercase" name="include_lowercase" <?php echo $includeLowercase ? 'checked' : ''; ?>>
                <label for="include_lowercase">Incluir Minúsculas (a-z)</label>
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="include_numbers" name="include_numbers" <?php echo $includeNumbers ? 'checked' : ''; ?>>
                <label for="include_numbers">Incluir Números (0-9)</label>
            </div>
            <div class="form-group checkbox-group">
                <input type="checkbox" id="include_symbols" name="include_symbols" <?php echo $includeSymbols ? 'checked' : ''; ?>>
                <label for="include_symbols">Incluir Símbolos (!@#$...)</label>
            </div>
            <button type="submit" class="generate-button">Generar Contraseña</button>
        </form>

        <?php if (!empty($password)): ?>
            <div class="password-output">
                <label for="generated_password">Tu Contraseña Segura:</label>
                <input type="text" id="generated_password" value="<?php echo htmlspecialchars($password); ?>" readonly>
                <button class="copy-button" onclick="copyPassword()">Copiar</button>
            </div>
        <?php endif; ?>
        <?php
        // En 3raya/index.php, ajedrez/index.php, etc.

        // ... Tu código PHP

        // Incluir el footer.php que está un nivel arriba
        include '../footer.php';

        // O, si quieres asegurarte de que solo se incluya una vez y parar la ejecución si no se encuentra:
        // require_once '../footer.php';
        ?>
    </div>

    <script>
        function copyPassword() {
            const passwordField = document.getElementById('generated_password');
            passwordField.select(); // Selecciona el texto del campo
            passwordField.setSelectionRange(0, 99999); // Para dispositivos móviles
            document.execCommand('copy'); // Copia el texto al portapapeles
            alert('¡Contraseña copiada al portapapeles!');
        }
    </script>
</body>
</html>