<?php
/*
 * =============================================
 * EJERCICIOS PRÁCTICOS DE PHP - NIVEL AVANZADO
 * =============================================
 * Este documento contiene ejercicios prácticos que cubren:
 * - Manipulación avanzada de arrays
 * - Funciones complejas
 * - Programación orientada a objetos
 * - Manejo de archivos
 * - Conexión a bases de datos
 * - Seguridad
 */

// =============================================
// 1. MANIPULACIÓN AVANZADA DE ARRAYS
// =============================================

echo "<h2>1. Manipulación Avanzada de Arrays</h2>";

// Array multidimensional complejo
$empleados = [
    ["id" => 1, "nombre" => "Ana", "departamento" => "Ventas", "salario" => 3500],
    ["id" => 2, "nombre" => "Carlos", "departamento" => "IT", "salario" => 4200],
    ["id" => 3, "nombre" => "Marta", "departamento" => "Ventas", "salario" => 3800],
    ["id" => 4, "nombre" => "Javier", "departamento" => "RH", "salario" => 3100],
    ["id" => 5, "nombre" => "Laura", "departamento" => "IT", "salario" => 4500]
];

// Ejemplo 1: Filtrar empleados por departamento
$departamento = "IT";
$empleadosIT = array_filter($empleados, function($empleado) use ($departamento) {
    return $empleado['departamento'] === $departamento;
});

echo "<h3>Empleados de IT:</h3>";
print_r($empleadosIT);

// Ejemplo 2: Obtener la suma de salarios por departamento
$salariosPorDepto = array_reduce($empleados, function($carry, $empleado) {
    $depto = $empleado['departamento'];
    $carry[$depto] = ($carry[$depto] ?? 0) + $empleado['salario'];
    return $carry;
}, []);

echo "<h3>Salarios por departamento:</h3>";
print_r($salariosPorDepto);

// Ejemplo 3: Ordenar empleados por salario (descendente)
usort($empleados, function($a, $b) {
    return $b['salario'] <=> $a['salario'];
});

echo "<h3>Empleados ordenados por salario:</h3>";
print_r($empleados);

// =============================================
// 2. FUNCIONES AVANZADAS
// =============================================

echo "<h2>2. Funciones Avanzadas</h2>";

// Ejemplo 1: Función recursiva para factorial
function factorial($n) {
    if ($n <= 1) return 1;
    return $n * factorial($n - 1);
}

echo "<p>Factorial de 5: " . factorial(5) . "</p>";

// Ejemplo 2: Función con parámetros variables
function sumaDinamica(...$numeros) {
    return array_reduce($numeros, function($carry, $num) {
        return $carry + $num;
    }, 0);
}

echo "<p>Suma dinámica: " . sumaDinamica(1, 2, 3, 4, 5) . "</p>";

// Ejemplo 3: Closure con estado
function contador() {
    $count = 0;
    return function() use (&$count) {
        return ++$count;
    };
}

$miContador = contador();
echo "<p>Contador: " . $miContador() . "</p>";
echo "<p>Contador: " . $miContador() . "</p>";
echo "<p>Contador: " . $miContador() . "</p>";

// =============================================
// 3. PROGRAMACIÓN ORIENTADA A OBJETOS
// =============================================

echo "<h2>3. Programación Orientada a Objetos</h2>";

// Ejemplo 1: Clase básica con herencia
class Producto {
    protected $nombre;
    protected $precio;
    
    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
    
    public function getPrecioConIVA($iva = 0.21) {
        return $this->precio * (1 + $iva);
    }
    
    public function getInfo() {
        return "{$this->nombre} - \${$this->precio}";
    }
}

class ProductoDigital extends Producto {
    private $tamañoMB;
    
    public function __construct($nombre, $precio, $tamañoMB) {
        parent::__construct($nombre, $precio);
        $this->tamañoMB = $tamañoMB;
    }
    
    public function getInfo() {
        return parent::getInfo() . " - {$this->tamañoMB}MB";
    }
}

$libro = new Producto("PHP Avanzado", 29.99);
$curso = new ProductoDigital("Curso PHP", 49.99, 150);

echo "<p>" . $libro->getInfo() . "</p>";
echo "<p>" . $curso->getInfo() . "</p>";
echo "<p>Precio con IVA: " . $libro->getPrecioConIVA() . "</p>";

// Ejemplo 2: Interface y Trait
interface Loggable {
    public function log($mensaje);
}

trait Logger {
    public function log($mensaje) {
        echo "<p>Log: " . date('Y-m-d H:i:s') . " - $mensaje</p>";
    }
}

class Usuario implements Loggable {
    use Logger;
    
    private $nombre;
    
    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->log("Usuario {$nombre} creado");
    }
}

$usuario = new Usuario("admin");

// =============================================
// 4. MANEJO DE ARCHIVOS
// =============================================

echo "<h2>4. Manejo de Archivos</h2>";

// Ejemplo 1: Leer y escribir archivos
$archivo = 'datos.txt';

// Escribir en archivo
file_put_contents($archivo, "Línea 1\nLínea 2\nLínea 3");

// Leer archivo línea por línea
echo "<h3>Contenido del archivo:</h3>";
if (file_exists($archivo)) {
    $lineas = file($archivo);
    foreach ($lineas as $num => $linea) {
        echo "<p>Línea " . ($num + 1) . ": " . htmlspecialchars($linea) . "</p>";
    }
}

// Ejemplo 2: Subida de archivos segura
echo '<form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="archivo_subido">
        <input type="submit" value="Subir">
      </form>';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo_subido'])) {
    $directorioSubida = 'uploads/';
    $nombreArchivo = basename($_FILES['archivo_subido']['name']);
    $rutaCompleta = $directorioSubida . $nombreArchivo;
    $extension = strtolower(pathinfo($rutaCompleta, PATHINFO_EXTENSION));
    
    // Validar tipo de archivo
    $extensionesPermitidas = ['jpg', 'png', 'pdf'];
    
    if (in_array($extension, $extensionesPermitidas)) {
        if (move_uploaded_file($_FILES['archivo_subido']['tmp_name'], $rutaCompleta)) {
            echo "<p>Archivo subido correctamente.</p>";
        } else {
            echo "<p>Error al subir el archivo.</p>";
        }
    } else {
        echo "<p>Tipo de archivo no permitido.</p>";
    }
}

// =============================================
// 5. CONEXIÓN A BASE DE DATOS (MySQLi)
// =============================================

echo "<h2>5. Conexión a Base de Datos</h2>";

$config = [
    'host' => 'localhost',
    'usuario' => 'root',
    'password' => '',
    'basedatos' => 'test'
];

function conectarDB($config) {
    $conexion = new mysqli($config['host'], $config['usuario'], $config['password'], $config['basedatos']);
    
    if ($conexion->connect_error) {
        die("<p>Error de conexión: " . $conexion->connect_error . "</p>");
    }
    
    return $conexion;
}

// Ejemplo 1: Consulta preparada (simulada)
echo "<h3>Consulta a base de datos (simulada):</h3>";

$conexion = conectarDB($config);

// Crear tabla (solo para demostración)
$sql = "CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10,2) NOT NULL
)";

// CORRECCIÓN: Había un error en esta línea - faltaba el paréntesis de cierre
if ($conexion->query($sql)) {
    echo "<p>Tabla creada/existe.</p>";
} else {
    echo "<p>Error al crear tabla: " . $conexion->error . "</p>";
}

// Insertar datos de ejemplo (preparado)
$stmt = $conexion->prepare("INSERT INTO productos (nombre, precio) VALUES (?, ?)");
$productosEjemplo = [
    ['Laptop', 999.99],
    ['Teléfono', 699.99],
    ['Tablet', 349.99]
];

foreach ($productosEjemplo as $producto) {
    $stmt->bind_param("sd", $producto[0], $producto[1]);
    $stmt->execute();
}
echo "<p>Datos de ejemplo insertados.</p>";

// Consultar datos
$resultado = $conexion->query("SELECT id, nombre, precio FROM productos");
if ($resultado->num_rows > 0) {
    echo "<ul>";
    while($fila = $resultado->fetch_assoc()) {
        echo "<li>#{$fila['id']} {$fila['nombre']} - \${$fila['precio']}</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No se encontraron productos.</p>";
}

$conexion->close();

// =============================================
// 6. SEGURIDAD EN PHP
// =============================================

echo "<h2>6. Seguridad en PHP</h2>";

// Ejemplo 1: Validación de entrada
$inputUsuario = '<script>alert("XSS");</script>';

echo "<h3>Validación y sanitización:</h3>";
echo "<p>Input original: " . htmlspecialchars($inputUsuario) . "</p>";

// SOLUCIÓN: Creamos una nueva conexión para este ejemplo
$conexionSeguridad = conectarDB($config);

// Sanitizar para diferentes contextos
$sanitizadoHTML = htmlspecialchars($inputUsuario, ENT_QUOTES, 'UTF-8');
$sanitizadoSQL = $conexionSeguridad->real_escape_string($inputUsuario);
$sanitizadoURL = urlencode($inputUsuario);

echo "<p>Sanitizado HTML: $sanitizadoHTML</p>";
echo "<p>Sanitizado SQL: $sanitizadoSQL</p>";
echo "<p>Sanitizado URL: $sanitizadoURL</p>";

// Cerramos esta conexión específica
$conexionSeguridad->close();

// Ejemplo 2: Hash de contraseñas
$contraseñaPlana = "miContraseñaSegura123";
$hash = password_hash($contraseñaPlana, PASSWORD_BCRYPT);

echo "<h3>Hash de contraseñas:</h3>";
echo "<p>Contraseña original: $contraseñaPlana</p>";
echo "<p>Hash almacenado: $hash</p>";

// Verificar contraseña
$contraseñaIngresada = "miContraseñaSegura123";
if (password_verify($contraseñaIngresada, $hash)) {
    echo "<p>¡Contraseña válida!</p>";
} else {
    echo "<p>Contraseña incorrecta.</p>";
}

// =============================================
// 7. EJERCICIO INTEGRADOR
// =============================================

echo "<h2>7. Ejercicio Integrador: Sistema de Blog</h2>";

class EntradaBlog {
    private $id;
    private $titulo;
    private $contenido;
    private $autor;
    private $fecha;
    
    public function __construct($titulo, $contenido, $autor) {
        $this->id = uniqid();
        $this->titulo = $titulo;
        $this->contenido = $contenido;
        $this->autor = $autor;
        $this->fecha = new DateTime();
    }
    
    public function mostrarResumen() {
        return "<article>
            <h3>{$this->titulo}</h3>
            <p>" . substr($this->contenido, 0, 100) . "...</p>
            <footer>Por {$this->autor} - {$this->fecha->format('d/m/Y')}</footer>
        </article>";
    }
}

// Crear algunas entradas
$entradas = [
    new EntradaBlog("Aprendiendo PHP", "PHP es un lenguaje de scripting muy potente...", "Ana"),
    new EntradaBlog("POO en PHP", "La programación orientada a objetos permite...", "Carlos"),
    new EntradaBlog("Seguridad Web", "Es fundamental proteger nuestras aplicaciones...", "Marta")
];

// Mostrar el blog
echo "<div class='blog'>";
foreach ($entradas as $entrada) {
    echo $entrada->mostrarResumen();
}
echo "</div>";

// =============================================
// ESTILOS PARA MEJORAR LA PRESENTACIÓN
// =============================================
?>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
    }
    h2 {
        color: #2c3e50;
        border-bottom: 2px solid #3498db;
        padding-bottom: 10px;
        margin-top: 40px;
    }
    h3 {
        color: #2980b9;
    }
    p, li {
        margin: 10px 0;
    }
    ul {
        padding-left: 20px;
    }
    article {
        background: white;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    article h3 {
        margin-top: 0;
        color: #2c3e50;
    }
    article footer {
        font-size: 0.9em;
        color: #7f8c8d;
        margin-top: 10px;
    }
    .blog {
        margin-top: 30px;
    }
    pre {
        background: #f5f5f5;
        padding: 15px;
        border-radius: 5px;
        overflow-x: auto;
    }
</style>