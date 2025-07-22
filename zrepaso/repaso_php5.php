<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Apuntes de PHP Dinámicos - Parte 3</title>
    <style>
        /* Estilos CSS para un aspecto más dinámico y el menú lateral */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            color: #333;
            display: flex; /* Usamos flexbox para el layout */
            min-height: 100vh; /* Para que el body ocupe al menos toda la altura de la ventana */
        }

        #sidebar {
            width: 250px;
            background-color: #2c3e50; /* Color oscuro para el menú */
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            position: sticky; /* Menú pegajoso al hacer scroll */
            top: 0;
            height: 100vh; /* Ocupa toda la altura de la vista */
            overflow-y: auto; /* Permite scroll si el contenido es largo */
        }

        #sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ecf0f1;
        }

        #sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #sidebar ul li a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: #bdc3c7; /* Color de texto suave */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        #sidebar ul li a:hover,
        #sidebar ul li a.active { /* Clase para el elemento activo */
            background-color: #34495e;
            color: #ffffff;
        }

        #content {
            flex-grow: 1; /* El contenido toma el espacio restante */
            padding: 30px;
            max-width: 800px; /* Limita el ancho del contenido principal */
            margin: 0 auto; /* Centra el contenido */
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            line-height: 1.6;
        }

        #content h1, #content h2, #content h3 {
            color: #2980b9; /* Color de título principal */
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
            margin-top: 40px;
        }

        #content pre {
            background-color: #e8f0f4;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto; /* Para código largo */
        }

        /* Estilos para el código PHP dentro de los apuntes */
        pre code {
            /* General para el texto dentro de pre code */
            color: #333; /* Color de texto por defecto */
        }
        /* Resaltado de sintaxis básico para PHP */
        pre .php-tag { color: #8e44ad; font-weight: bold; } /* <?php ?> */
        pre .php-keyword { color: #8e44ad; font-weight: bold; } /* Palabras clave como function, class, echo, var_dump, include, if, else, etc. */
        pre .php-variable { color: #f39c12; } /* Variables $nombre */
        pre .php-string { color: #27ae60; } /* Cadenas de texto */
        pre .php-number { color: #c0392b; } /* Números */
        pre .php-comment { color: #7f8c8d; font-style: italic; } /* Comentarios */
        pre .php-operator { color: #34495e; } /* Operadores como =, +, -, >, <, ., etc. */
        pre .php-builtin { color: #2980b9; } /* Funciones integradas como strlen, array, define, etc. */


        /* Media Queries para diseño responsivo */
        @media (max-width: 768px) {
            body {
                flex-direction: column; /* Apila el menú y el contenido en pantallas pequeñas */
            }
            #sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: none;
            }
            #sidebar ul {
                display: flex; /* Menú horizontal en móvil */
                flex-wrap: wrap;
                justify-content: center;
            }
            #sidebar ul li a {
                padding: 10px 15px;
            }
            #content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <aside id="sidebar">
        <h2>Apuntes PHP (III)</h2>
        <ul>
            <li><a href="#superglobales">Variables Superglobales</a></li>
            <li><a href="#formularios">Manejo de Formularios</a></li>
            <li><a href="#validacion">Validación de Datos</a></li>
            <li><a href="#inclusion_archivos">Inclusión de Archivos</a></li>
        </ul>
    </aside>

    <main id="content">
        <h1>Interacción y Gestión de Datos en PHP</h1>

        <?php
        // Función auxiliar para aplicar resaltado de sintaxis básico
        function highlight_php_code($code) {
            $code = htmlspecialchars($code); // Escapa caracteres HTML para evitar XSS
            $code = preg_replace('/&lt;\?php/', '<span class="php-tag">&lt;?php</span>', $code);
            $code = preg_replace('/\?&gt;/', '<span class="php-tag">?&gt;</span>', $code);
            $code = preg_replace('/\b(function|class|echo|var_dump|include|if|else|elseif|while|for|foreach|return|new|public|private|static|global|const|define|true|false|null|array|__construct|__CLASS__|__DIR__|__FILE__|__FUNCTION__|__LINE__|__METHOD__|__NAMESPACE__|__TRAIT__|Classname::class|break|continue|default|switch|case|isset|empty|htmlspecialchars|trim|stripslashes)\b/', '<span class="php-keyword">$1</span>', $code);
            $code = preg_replace('/(\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/', '<span class="php-variable">$1</span>', $code);
            $code = preg_replace('/(".*?")|(\'.*?\')/', '<span class="php-string">$0</span>', $code);
            $code = preg_replace('/\b(\d+\.?\d*)\b/', '<span class="php-number">$0</span>', $code);
            $code = preg_replace('/\/\/(.*?)(\r?\n|$)/', '<span class="php-comment">//$1</span>$2', $code); // Comentarios de una línea
            $code = preg_replace('/(\/\*.*?\*\/)/s', '<span class="php-comment">$1</span>', $code); // Comentarios de varias líneas
            $code = preg_replace('/([+\-*\/=<>!&|.%])/', '<span class="php-operator">$1</span>', $code); // Operadores
            // Funciones built-in adicionales
            $code = preg_replace('/\b(strlen|str_word_count|strpos|strtoupper|strtolower|str_replace|strrev|trim|explode|print_r|substr|is_int|is_float|is_numeric|acos|pi|min|max|abs|sqrt|round|rand|count|sort|rsort|asort|ksort|array_push|array_pop|implode|array_values|array_keys|header)\b/', '<span class="php-builtin">$1</span>', $code);

            return '<pre><code>' . $code . '</code></pre>';
        }

        ?>

        <div id="superglobales">
            <h2>Variables Superglobales</h2>
            <p>Las variables superglobales son arrays integrados en PHP que están siempre disponibles en todos los ámbitos (local y global) de un script. No necesitan ser declaradas con `global $variable;`.</p>

            <h3>`$_GET`</h3>
            <p>Se utiliza para recolectar datos enviados mediante el método HTTP GET. Los datos son visibles en la URL y tienen un límite de tamaño.</p>
            <p>Útil para: búsquedas, paginación, marcadores.</p>
            <?php echo highlight_php_code('
// Ejemplo de URL: http://localhost/repaso_php5.php?nombre=Juan&edad=30
if (isset($_GET["nombre"])) {
    echo "Hola, " . htmlspecialchars($_GET["nombre"]) . "!<br>";
}
if (isset($_GET["edad"])) {
    echo "Tu edad es: " . htmlspecialchars($_GET["edad"]) . " años.<br>";
}
            '); ?>
            <p>Para probar esto, guarda el archivo, ábrelo en tu navegador y añade `?nombre=TuNombre&edad=TuEdad` a la URL.</p>

            <h3>`$_POST`</h3>
            <p>Se utiliza para recolectar datos enviados mediante el método HTTP POST. Los datos no son visibles en la URL y no tienen un límite práctico de tamaño.</p>
            <p>Útil para: envío de formularios con información sensible (contraseñas), envío de archivos, formularios con muchos datos.</p>
            <?php echo highlight_php_code('
// Este código solo se ejecutará si se envía un formulario con método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["usuario"])) {
        echo "Usuario enviado (POST): " . htmlspecialchars($_POST["usuario"]) . "<br>";
    }
    if (isset($_POST["password"])) {
        echo "Contraseña enviada (POST): " . htmlspecialchars($_POST["password"]) . " (¡No mostraría esto en una app real!)<br>";
    }
}
            '); ?>

            <h3>`$_REQUEST`</h3>
            <p>Contiene el contenido de `$_GET`, `$_POST` y `$_COOKIE`. Es una combinación y puede ser útil si no estás seguro de qué método se usó, pero es menos específico y a menudo se prefiere usar `$_GET` o `$_POST` directamente por seguridad y claridad.</p>
            <?php echo highlight_php_code('
// Si se envía por GET o POST, $_REQUEST lo capturará
if (isset($_REQUEST["parametro"])) {
    echo "Parámetro capturado por REQUEST: " . htmlspecialchars($_REQUEST["parametro"]) . "<br>";
}
            '); ?>
        </div>

        <div id="formularios">
            <h2>Manejo de Formularios HTML con PHP</h2>
            <p>La forma más común de interactuar con el usuario en PHP es a través de formularios HTML.</p>

            <h3>Creación de un Formulario Básico</h3>
            <p>Los formularios HTML necesitan el atributo `action` (a dónde se envían los datos) y `method` (cómo se envían los datos: GET o POST).</p>
            <?php echo highlight_php_code('
// Si este código está en repaso_php5.php, el action apunta a sí mismo
echo \'
<form action="repaso_php5.php" method="post">
    <label for="nombre_usuario">Nombre:</label><br>
    <input type="text" id="nombre_usuario" name="nombre_usuario" value=""><br><br>
    <label for="email_usuario">Email:</label><br>
    <input type="email" id="email_usuario" name="email_usuario" value=""><br><br>
    <input type="submit" value="Enviar Datos">
</form>
\';
            '); ?>

            <h3>Procesando los Datos del Formulario</h3>
            <p>Para procesar los datos, PHP verifica si el formulario ha sido enviado (usualmente con `$_SERVER["REQUEST_METHOD"] == "POST"`) y luego accede a los valores de los campos usando `$_POST` (o `$_GET` si el método fuera GET).</p>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre_enviado = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : '';
                $email_enviado = isset($_POST['email_usuario']) ? $_POST['email_usuario'] : '';

                echo "<h3>Datos recibidos:</h3>";
                echo "Nombre: " . htmlspecialchars($nombre_enviado) . "<br>";
                echo "Email: " . htmlspecialchars($email_enviado) . "<br>";
            }
            ?>
            <p>El código PHP para procesar el formulario debería estar al principio del mismo archivo (`repaso_php5.php`) o en un archivo separado al que apunta el `action` del formulario.</p>
            <?php echo highlight_php_code('
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_recibido = $_POST["nombre_usuario"];
    $email_recibido = $_POST["email_usuario"];

    echo "Nombre: " . $nombre_recibido . "<br>";
    echo "Email: " . $email_recibido . "<br>";
}
            '); ?>
        </div>

        <div id="validacion">
            <h2>Validación y Limpieza de Datos</h2>
            <p>Es crucial validar y limpiar los datos recibidos de un formulario para prevenir ataques (como inyección de código) y asegurar la integridad de los datos.</p>
            <p>Nunca confíes en los datos que vienen del usuario.</p>

            <h3>Funciones Útiles para Validación y Limpieza:</h3>
            <ul>
                <li>`isset()`: Verifica si una variable está definida y no es `NULL`.</li>
                <li>`empty()`: Verifica si una variable está vacía (considera 0, "", false, null, array vacío como vacío).</li>
                <li>`trim()`: Elimina espacios en blanco (u otros caracteres) del principio y final de una cadena.</li>
                <li>`stripslashes()`: Elimina las barras invertidas añadidas por la función `addslashes()` (útil para datos que vienen de bases de datos).</li>
                <li>`htmlspecialchars()`: Convierte caracteres especiales HTML en entidades HTML. **Esencial para evitar ataques XSS** al mostrar datos en el navegador.</li>
                <li>`filter_var()`: Una función muy potente para validar y limpiar datos de forma más avanzada (emails, URLs, números, etc.).</li>
            </ul>

            <h3>Ejemplo de Validación Básica:</h3>
            <?php echo highlight_php_code('
$nombreErr = $emailErr = "";
$nombre = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar Nombre
    if (empty($_POST["nombre_usuario"])) {
        $nombreErr = "El nombre es requerido";
    } else {
        $nombre = test_input($_POST["nombre_usuario"]);
        // Comprobar si el nombre solo contiene letras y espacios
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*$/",$nombre)) {
            $nombreErr = "Solo se permiten letras y espacios en blanco";
        }
    }

    // Validar Email
    if (empty($_POST["email_usuario"])) {
        $emailErr = "El email es requerido";
    } else {
        $email = test_input($_POST["email_usuario"]);
        // Comprobar si el formato de email es válido
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Formato de email inválido";
        }
    }

    // Si no hay errores, procesar los datos
    if (empty($nombreErr) && empty($emailErr) && !empty($nombre) && !empty($email)) {
        echo "<h3>Datos Validados y Limpiados:</h3>";
        echo "Nombre: " . $nombre . "<br>";
        echo "Email: " . $email . "<br>";
    } else {
        echo "<h3>Errores en el formulario:</h3>";
        echo "Nombre Error: " . $nombreErr . "<br>";
        echo "Email Error: " . $emailErr . "<br>";
    }
}

// Función de limpieza de datos
function test_input($data) {
    $data = trim($data);            // Elimina espacios en blanco al principio/final
    $data = stripslashes($data);    // Elimina barras invertidas
    $data = htmlspecialchars($data); // Convierte caracteres especiales a entidades HTML
    return $data;
}
            '); ?>
            <p>Este ejemplo muestra cómo se combinaría el formulario HTML con el código PHP de validación en el mismo archivo. Las variables `$nombreErr` y `$emailErr` se usarían para mostrar mensajes de error al lado de los campos del formulario.</p>
        </div>

        <div id="inclusion_archivos">
            <h2>Inclusión de Archivos</h2>
            <p>PHP permite incluir un archivo de PHP en otro archivo de PHP antes de que el servidor lo ejecute. Esto es útil para reutilizar código (ej: cabeceras, pies de página, funciones comunes, archivos de configuración).</p>

            <h3>`include`</h3>
            <p>Incluye el archivo especificado. Si el archivo no se encuentra, produce una advertencia (`E_WARNING`) y el script continúa su ejecución.</p>
            <?php echo highlight_php_code('
// Contenido de "header.php": <h1>Mi Web</h1>
// Contenido de "footer.php": <p>&copy; 2025 Mi Empresa</p>

// Esto estaría en tu archivo principal (ej: index.php)
// include "header.php";
// echo "<p>Contenido principal de la página.</p>";
// include "footer.php";

// Si el archivo no existe:
// include "archivo_que_no_existe.php"; // Genera un warning, pero el script sigue
echo "El script continúa después del include con warning.<br>";
            '); ?>

            <h3>`require`</h3>
            <p>Es idéntico a `include` excepto que si el archivo no se encuentra, produce un error fatal (`E_COMPILE_ERROR`) y detiene la ejecución del script.</p>
            <p>Útil para: archivos esenciales sin los cuales el script no puede funcionar (ej: conexión a base de datos, funciones críticas).</p>
            <?php echo highlight_php_code('
// require "db_config.php"; // Si db_config.php no existe, el script se detendrá
echo "Este mensaje no se mostrará si \"db_config.php\" no existe y se usa require.<br>";
            '); ?>

            <h3>`include_once` y `require_once`</h3>
            <p>Estas variantes aseguran que el archivo solo sea incluido una vez, incluso si la sentencia aparece varias veces en el script. Esto previene problemas con la redefinición de funciones, clases o variables.</p>
            <?php echo highlight_php_code('
// Ejemplo de uso:
// include_once "funciones_comunes.php";
// include_once "funciones_comunes.php"; // Esta segunda inclusión será ignorada

// require_once "clases/BaseDeDatos.php";
            '); ?>
        </div>

    </main>

    <script>
        // JavaScript para resaltar el elemento activo en el menú y manejar el scroll
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLinks = document.querySelectorAll('#sidebar ul li a');
            const sections = document.querySelectorAll('main div[id]'); // Selecciona divs con ID en el main

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Elimina la clase 'active' de todos los enlaces
                        sidebarLinks.forEach(link => link.classList.remove('active'));
                        // Añade la clase 'active' al enlace correspondiente a la sección visible
                        const correspondingLink = document.querySelector(`#sidebar ul li a[href="#${entry.target.id}"]`);
                        if (correspondingLink) {
                            correspondingLink.classList.add('active');
                        }
                    }
                });
            }, {
                rootMargin: '0px 0px -50% 0px' // La sección se considera "intersecting" cuando está más allá de la mitad de la pantalla
            });

            sections.forEach(section => {
                observer.observe(section);
            });
        });
    </script>
</body>
</html>