<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demostración de Formularios PHP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 800px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #0056b3; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 30px; }
        form { background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ddd; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="number"], textarea, select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Para que el padding no aumente el ancho total */
        }
        input[type="checkbox"], input[type="radio"] {
            margin-right: 5px;
        }
        .form-group { margin-bottom: 15px; }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: auto;
        }
        input[type="submit"]:hover { background-color: #218838; }
        .result-box { background-color: #e6f7ff; color: #0056b3; border: 1px solid #b3d7ff; border-radius: 5px; padding: 15px; margin-top: 20px; }
        .error-message { color: #dc3545; font-size: 0.9em; margin-top: -10px; margin-bottom: 10px; }
        pre { background-color: #e9e9e9; padding: 15px; border-radius: 5px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Demostración de Formularios PHP</h1>
        <p>Aquí aprenderás cómo PHP maneja los datos enviados desde formularios HTML usando los métodos GET y POST.</p>

        <?php
        // --- Procesamiento del formulario POST ---
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<h2>Datos recibidos por POST:</h2>";
            echo "<div class='result-box'>";

            // Validar y sanear datos
            $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            $mensaje = isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : '';
            $genero = isset($_POST['genero']) ? htmlspecialchars($_POST['genero']) : '';
            $intereses = isset($_POST['intereses']) && is_array($_POST['intereses']) ? array_map('htmlspecialchars', $_POST['intereses']) : [];
            $pais = isset($_POST['pais']) ? htmlspecialchars($_POST['pais']) : '';

            $errores = [];

            if (empty($nombre)) {
                $errores[] = "El nombre es obligatorio.";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores[] = "El email no es válido o está vacío.";
            }
            // Agrega más validaciones según sea necesario

            if (empty($errores)) {
                echo "<p><strong>Nombre:</strong> " . ($nombre ?: 'No especificado') . "</p>";
                echo "<p><strong>Email:</strong> " . ($email ?: 'No especificado') . "</p>";
                echo "<p><strong>Género:</strong> " . ($genero ?: 'No especificado') . "</p>";
                echo "<p><strong>Intereses:</strong> " . (!empty($intereses) ? implode(", ", $intereses) : 'Ninguno') . "</p>";
                echo "<p><strong>País:</strong> " . ($pais ?: 'No seleccionado') . "</p>";
                echo "<p><strong>Mensaje:</strong> <pre>" . ($mensaje ?: 'No especificado') . "</pre></p>";

                echo "<h3>Array \$_POST completo:</h3>";
                echo "<pre>";
                print_r($_POST);
                echo "</pre>";
                echo "<p style='color: green; font-weight: bold;'>¡Datos de formulario procesados correctamente!</p>";

                // Aquí podrías guardar los datos en una base de datos, enviar un email, etc.
            } else {
                echo "<p style='color: red; font-weight: bold;'>Errores encontrados:</p>";
                echo "<ul>";
                foreach ($errores as $error) {
                    echo "<li class='error-message'>" . $error . "</li>";
                }
                echo "</ul>";
            }
            echo "</div>";
        }

        // --- Procesamiento del formulario GET ---
        if ($_SERVER["REQUEST_METHOD"] == "GET" && (isset($_GET['query']) || isset($_GET['categoria']))) {
            echo "<h2>Datos recibidos por GET:</h2>";
            echo "<div class='result-box'>";
            $query = isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '';
            $categoria = isset($_GET['categoria']) ? htmlspecialchars($_GET['categoria']) : '';

            echo "<p><strong>Búsqueda:</strong> " . ($query ?: 'No especificado') . "</p>";
            echo "<p><strong>Categoría:</strong> " . ($categoria ?: 'No especificado') . "</p>";

            echo "<h3>Array \$_GET completo:</h3>";
            echo "<pre>";
            print_r($_GET);
            echo "</pre>";
            echo "</div>";
        }
        ?>

        <h2>Formulario de Contacto (Método POST)</h2>
        <form action="009.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="tu.email@example.com" required>
            </div>

            <div class="form-group">
                <label>Género:</label><br>
                <input type="radio" id="masculino" name="genero" value="masculino">
                <label for="masculino" style="display: inline;">Masculino</label><br>
                <input type="radio" id="femenino" name="genero" value="femenino">
                <label for="femenino" style="display: inline;">Femenino</label><br>
                <input type="radio" id="otro_genero" name="genero" value="otro">
                <label for="otro_genero" style="display: inline;">Otro</label>
            </div>

            <div class="form-group">
                <label>Intereses:</label><br>
                <input type="checkbox" id="interes1" name="intereses[]" value="programacion">
                <label for="interes1" style="display: inline;">Programación</label><br>
                <input type="checkbox" id="interes2" name="intereses[]" value="diseno">
                <label for="interes2" style="display: inline;">Diseño</label><br>
                <input type="checkbox" id="interes3" name="intereses[]" value="marketing">
                <label for="interes3" style="display: inline;">Marketing</label>
            </div>

            <div class="form-group">
                <label for="pais">País:</label>
                <select id="pais" name="pais">
                    <option value="">-- Selecciona un país --</option>
                    <option value="es">España</option>
                    <option value="mx">México</option>
                    <option value="ar">Argentina</option>
                    <option value="cl">Chile</option>
                    <option value="co">Colombia</option>
                    <option value="ot">Otro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>

            <input type="submit" value="Enviar Formulario POST">
        </form>

        <h2>Formulario de Búsqueda (Método GET)</h2>
        <form action="009.php" method="GET">
            <div class="form-group">
                <label for="query">Término de búsqueda:</label>
                <input type="text" id="query" name="query" placeholder="Buscar...">
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <select id="categoria" name="categoria">
                    <option value="">Todas</option>
                    <option value="web">Desarrollo Web</option>
                    <option value="movil">Desarrollo Móvil</option>
                    <option value="datos">Ciencia de Datos</option>
                </select>
            </div>
            <input type="submit" value="Buscar con GET">
        </form>

    </div>

</body>
</html>