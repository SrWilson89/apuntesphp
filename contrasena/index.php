<?php
// Incluir el archivo de lógica PHP para el generador de contraseñas
require_once 'password_generator.php';
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