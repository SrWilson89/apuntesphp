<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen Completo de PHP - W3Schools</title>
    <style>
        /* Estilos mejorados */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f4f9;
            color: #333;
        }
        #menu {
            width: 280px;
            background: #2c3e50;
            color: white;
            padding: 20px 0;
            height: 100vh;
            position: fixed;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }
        #menu h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #ecf0f1;
            font-size: 1.5em;
        }
        #menu ul {
            list-style: none;
            padding: 0;
        }
        #menu li a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 12px 25px;
            border-bottom: 1px solid #34495e;
            transition: all 0.3s;
        }
        #menu li a:hover {
            background: #34495e;
            padding-left: 30px;
        }
        #content {
            margin-left: 280px;
            padding: 30px;
            flex: 1;
            background: white;
            line-height: 1.6;
        }
        .section {
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        h2 {
            color: #2980b9;
        }
        h3 {
            color: #16a085;
        }
        code {
            background: #eef2f3;
            padding: 3px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            color: #c0392b;
        }
        pre {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            border-left: 4px solid #3498db;
        }
        .note {
            background: #e3f2fd;
            padding: 10px;
            border-left: 4px solid #2196f3;
            margin: 15px 0;
        }
        .warning {
            background: #fff3e0;
            padding: 10px;
            border-left: 4px solid #ff9800;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <!-- Menú lateral -->
    <div id="menu">
        <h2>PHP - Resumen Completo</h2>
        <ul>
            <li><a href="#intro">Introducción</a></li>
            <li><a href="#sintaxis">Sintaxis básica</a></li>
            <li><a href="#variables">Variables</a></li>
            <li><a href="#arrays">Arrays</a></li>
            <li><a href="#condicionales">Condicionales</a></li>
            <li><a href="#bucles">Bucles</a></li>
            <li><a href="#funciones">Funciones</a></li>
            <li><a href="#formularios">Formularios</a></li>
            <li><a href="#poo">POO en PHP</a></li>
            <li><a href="#archivos">Manejo de archivos</a></li>
            <li><a href="#sesiones">Sesiones & Cookies</a></li>
            <li><a href="#db">Bases de datos</a></li>
            <li><a href="#seguridad">Seguridad</a></li>
        </ul>
    </div>

    <!-- Contenido principal -->
    <div id="content">
        <h1>Resumen Completo de PHP (W3Schools)</h1>

        <!-- Sección: Introducción -->
        <div id="intro" class="section">
            <h2>Introducción a PHP</h2>
            <p>PHP (<strong>Hypertext Preprocessor</strong>) es un lenguaje de scripting del lado del servidor diseñado para desarrollo web.</p>
            <div class="note">
                <strong>Características clave:</strong> Open-source, soporte para múltiples bases de datos, integración con HTML, y amplia documentación.
            </div>
            <pre><code>&lt;?php
    // Ejemplo básico
    echo "Hola, mundo!";
    echo "PHP version: " . phpversion();
?&gt;</code></pre>
        </div>

        <!-- Sección: Sintaxis -->
        <div id="sintaxis" class="section">
            <h2>Sintaxis básica</h2>
            <ul>
                <li>Los scripts PHP se insertan entre <code>&lt;?php ... ?&gt;</code>.</li>
                <li>Las instrucciones terminan con <code>;</code>.</li>
                <li>Soporta comentarios de una línea (<code>//</code>) y múltiples líneas (<code>/* ... */</code>).</li>
            </ul>
            <pre><code>&lt;?php
    // Esto es un comentario
    /* Esto es un
       comentario multilínea */
    echo "Hola"; // Imprime "Hola"
?&gt;</code></pre>
        </div>

        <!-- Sección: Variables -->
        <div id="variables" class="section">
            <h2>Variables</h2>
            <p>En PHP, las variables comienzan con <code>$</code> y son de tipado dinámico.</p>
            <pre><code>&lt;?php
    $nombre = "Ana";       // String
    $edad = 25;            // Entero
    $altura = 1.75;        // Float
    $esEstudiante = true;  // Booleano
?&gt;</code></pre>
            <div class="note">
                <strong>Variables superglobales:</strong> <code>$_GET</code>, <code>$_POST</code>, <code>$_SERVER</code>, <code>$_SESSION</code>, etc.
            </div>
        </div>

        <!-- Sección: Arrays -->
        <div id="arrays" class="section">
            <h2>Arrays</h2>
            <p>PHP soporta arrays indexados, asociativos y multidimensionales.</p>
            <pre><code>&lt;?php
    // Array indexado
    $frutas = ["Manzana", "Banana", "Naranja"];

    // Array asociativo
    $persona = [
        "nombre" => "Carlos",
        "edad" => 30
    ];

    // Array multidimensional
    $matriz = [
        [1, 2, 3],
        [4, 5, 6]
    ];
?&gt;</code></pre>
            <h3>Funciones útiles para arrays:</h3>
            <pre><code>&lt;?php
    count($frutas);       // Cuenta elementos
    sort($frutas);        // Ordena
    array_push($frutas, "Pera"); // Añade elemento
?&gt;</code></pre>
        </div>

        <!-- Sección: Condicionales -->
        <div id="condicionales" class="section">
            <h2>Condicionales</h2>
            <pre><code>&lt;?php
    $edad = 18;

    if ($edad >= 18) {
        echo "Mayor de edad";
    } elseif ($edad >= 13) {
        echo "Adolescente";
    } else {
        echo "Niño";
    }

    // Operador ternario
    echo ($edad >= 18) ? "Adulto" : "Menor";
?&gt;</code></pre>
        </div>

        <!-- Sección: Bucles -->
        <div id="bucles" class="section">
            <h2>Bucles</h2>
            <h3>Bucle <code>for</code>:</h3>
            <pre><code>&lt;?php
    for ($i = 0; $i < 5; $i++) {
        echo "Número: $i &lt;br&gt;";
    }
?&gt;</code></pre>
            <h3>Bucle <code>foreach</code> (para arrays):</h3>
            <pre><code>&lt;?php
    $colores = ["Rojo", "Verde", "Azul"];

    foreach ($colores as $color) {
        echo "$color &lt;br&gt;";
    }

    // Con clave y valor
    foreach ($persona as $clave => $valor) {
        echo "$clave: $valor &lt;br&gt;";
    }
?&gt;</code></pre>
        </div>

        <!-- Sección: Funciones -->
        <div id="funciones" class="section">
            <h2>Funciones</h2>
            <pre><code>&lt;?php
    // Función básica
    function sumar($a, $b) {
        return $a + $b;
    }
    echo sumar(3, 5); // 8

    // Parámetros por defecto
    function saludar($nombre = "Invitado") {
        return "Hola, $nombre!";
    }
    echo saludar(); // "Hola, Invitado!"
?&gt;</code></pre>
        </div>

        <!-- Sección: Formularios -->
        <div id="formularios" class="section">
            <h2>Formularios PHP</h2>
            <p>Datos enviados por <code>GET</code> (visible en URL) o <code>POST</code> (oculto).</p>
            <pre><code>&lt;?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = htmlspecialchars($_POST['nombre']); // Sanitizar
        echo "Hola, $nombre!";
    }
?&gt;
&lt;form method="post" action="&lt;?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?&gt;"&gt;
    Nombre: &lt;input type="text" name="nombre" required&gt;
    &lt;input type="submit" value="Enviar"&gt;
&lt;/form&gt;</code></pre>
            <div class="warning">
                <strong>¡Importante!</strong> Siempre valida y sanitiza los datos de formularios para evitar inyecciones.
            </div>
        </div>

        <!-- Sección: POO -->
        <div id="poo" class="section">
            <h2>Programación Orientada a Objetos (POO)</h2>
            <h3>Clases y objetos:</h3>
            <pre><code>&lt;?php
    class Coche {
        // Propiedades
        public $marca;
        private $modelo; // Solo accesible dentro de la clase

        // Constructor
        public function __construct($marca, $modelo) {
            $this->marca = $marca;
            $this->modelo = $modelo;
        }

        // Método
        public function getInfo() {
            return "Marca: $this->marca, Modelo: $this->modelo";
        }
    }

    $miCoche = new Coche("Toyota", "Corolla");
    echo $miCoche->getInfo();
?&gt;</code></pre>
            <h3>Herencia:</h3>
            <pre><code>&lt;?php
    class Animal {
        public function hacerSonido() {
            return "Sonido genérico";
        }
    }

    class Perro extends Animal {
        public function hacerSonido() {
            return "Guau!";
        }
    }

    $perro = new Perro();
    echo $perro->hacerSonido(); // "Guau!"
?&gt;</code></pre>
        </div>

        <!-- Sección: Manejo de archivos -->
        <div id="archivos" class="section">
            <h2>Manejo de archivos</h2>
            <h3>Leer/escribir archivos:</h3>
            <pre><code>&lt;?php
    // Escribir
    $file = fopen("ejemplo.txt", "w");
    fwrite($file, "Hola, PHP!\n");
    fclose($file);

    // Leer
    echo file_get_contents("ejemplo.txt");

    // Subir archivo (HTML + PHP)
    if (isset($_FILES['archivo'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["archivo"]["name"]);
        move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file);
        echo "Archivo subido: " . htmlspecialchars($target_file);
    }
?&gt;
&lt;form method="post" enctype="multipart/form-data"&gt;
    Subir archivo: &lt;input type="file" name="archivo"&gt;
    &lt;input type="submit"&gt;
&lt;/form&gt;</code></pre>
        </div>

        <!-- Sección: Sesiones y Cookies -->
        <div id="sesiones" class="section">
            <h2>Sesiones y Cookies</h2>
            <h3>Sesiones:</h3>
            <pre><code>&lt;?php
    session_start();
    $_SESSION['usuario'] = "admin"; // Almacenar
    echo $_SESSION['usuario'];      // Recuperar

    // Destruir sesión
    session_unset();
    session_destroy();
?&gt;</code></pre>
            <h3>Cookies:</h3>
            <pre><code>&lt;?php
    setcookie("idioma", "español", time() + 3600, "/"); // Crear
    echo $_COOKIE['idioma'];                           // Leer

    // Eliminar
    setcookie("idioma", "", time() - 3600, "/");
?&gt;</code></pre>
        </div>

        <!-- Sección: Bases de datos -->
        <div id="db" class="section">
            <h2>Bases de datos (MySQLi)</h2>
            <pre><code>&lt;?php
    $servername = "localhost";
    $username = "usuario";
    $password = "contraseña";
    $dbname = "basedatos";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SELECT
    $sql = "SELECT id, nombre FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. "&lt;br&gt;";
        }
    } else {
        echo "0 resultados";
    }

    $conn->close();
?&gt;</code></pre>
            <div class="note">
                <strong>PDO (alternativa más segura):</strong> Usa <code>PDO</code> para consultas preparadas y soporte múltiple de bases de datos.
            </div>
        </div>

        <!-- Sección: Seguridad -->
        <div id="seguridad" class="section">
            <h2>Seguridad en PHP</h2>
            <h3>Prácticas esenciales:</h3>
            <ul>
                <li><strong>Validación de datos:</strong> Usa <code>filter_var()</code>.</li>
                <li><strong>Sanitización:</strong> <code>htmlspecialchars()</code>, <code>strip_tags()</code>.</li>
                <li><strong>Contraseñas:</strong> Hash con <code>password_hash()</code>.</li>
                <li><strong>SQL Injection:</strong> Usa consultas preparadas.</li>
            </ul>
            <pre><code>&lt;?php
    // Sanitizar entrada
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    // Hash de contraseña
    $hash = password_hash("miContraseña", PASSWORD_DEFAULT);

    // Verificar
    if (password_verify("miContraseña", $hash)) {
        echo "Contraseña válida!";
    }

    // Consulta preparada (MySQLi)
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
?&gt;</code></pre>
        </div>
    </div>
</body>
</html>
