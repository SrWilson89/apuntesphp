<?php

/**
 * Documento de Apuntes de PHP
 *
 * Este archivo contiene ejemplos y explicaciones de los conceptos fundamentales
 * y avanzados de PHP, desde la sintaxis básica hasta las características más recientes
 * como Enums, Fibers y Attributes.
 *
 * Para ejecutar este código:
 * 1. Asegúrate de tener un servidor web (como Apache o Nginx) con PHP instalado.
 * 2. Guarda este archivo como 'apuntes.php' (o cualquier otro nombre con extensión .php)
 * en el directorio raíz de tu servidor web (ej. htdocs para XAMPP/WAMP, www para MAMP).
 * 3. Accede a él desde tu navegador web: http://localhost/apuntes.php
 *
 * NOTA: Algunas secciones (como Fibers o Attributes) requieren PHP 8.1+ o 8.0+ respectivamente.
 * Si usas una versión anterior, esas partes podrían generar errores.
 */

// ---

## Sintaxis Básica

// El código PHP se encierra entre las etiquetas <?php y ?>
// Cada sentencia finaliza con un punto y coma (;).
// Los comentarios pueden ser de una línea (// o #) o de múltiples líneas (/* ... */).
echo "<h1>Apuntes de PHP</h1>";
echo "<p>¡Hola desde PHP!</p>";
// Esto es un comentario de una sola línea
# Otro tipo de comentario de una sola línea
/*
Esto es un comentario
de varias líneas
*/

echo "<hr>"; // Línea horizontal para separar secciones

// ---

## Tipos de Datos

echo "<h2>Tipos de Datos</h2>";

// Escalares
$booleano = true; // Boolean
$entero = 123;     // Integer
$flotante = 123.45; // Float (o Double)
$cadena = "Hola, mundo"; // String (comillas dobles o simples)

echo "<p>Booleano: " . ($booleano ? 'true' : 'false') . "</p>";
echo "<p>Entero: $entero</p>";
echo "<p>Flotante: $flotante</p>";
echo "<p>Cadena: $cadena</p>";

// Compuestos
$arrayNumerico = [1, 2, 3]; // Array indexado
$arrayAsociativo = ["nombre" => "Juan", "edad" => 30]; // Array asociativo

echo "<p>Array numérico: " . implode(", ", $arrayNumerico) . "</p>";
echo "<p>Array asociativo (nombre): " . $arrayAsociativo["nombre"] . "</p>";

// Objeto (ver sección de Clases y Objetos)
class Persona {
    public $nombre;
    public function __construct($nombre) { $this->nombre = $nombre; }
}
$objeto = new Persona("María");
echo "<p>Objeto (nombre): " . $objeto->nombre . "</p>";

// Especiales
$recurso = fopen("php://temp", "r+"); // Resource (ej. conexión a archivo o DB)
fclose($recurso); // Siempre cerrar recursos

$nulo = NULL; // NULL (variable sin valor asignado)
echo "<p>Variable nula: " . var_export($nulo, true) . "</p>";

echo "<hr>";

// ---

## Variables

echo "<h2>Variables</h2>";

$saludo = "Hola"; // Declaración y asignación
$nombre = "Carlos";
$mensaje = $saludo . " " . $nombre . "!"; // Concatenación con el operador '.'

echo "<p>$mensaje</p>";

// Las variables son sensibles a mayúsculas y minúsculas
$variableEjemplo = "valor 1";
$variableejemplo = "valor 2"; // Esta es una variable diferente

echo "<p>Variable ejemplo 1: $variableEjemplo</p>";
echo "<p>Variable ejemplo 2: $variableejemplo</p>";

echo "<hr>";

// ---

## Constantes

echo "<h2>Constantes</h2>";

// Definir constante con define() (disponible globalmente)
define("GRAVEDAD", 9.81);
echo "<p>La gravedad es: " . GRAVEDAD . " m/s²</p>";

// Definir constante con const (para constantes globales o de clase, a partir de PHP 5.3)
const MAX_CONEXIONES = 100;
echo "<p>Máximo de conexiones: " . MAX_CONEXIONES . "</p>";

// Constante de clase
class Configuracion {
    const DEBUG_MODE = true;
    const VERSION = "1.0.0";
}

echo "<p>Modo Debug: " . (Configuracion::DEBUG_MODE ? 'Sí' : 'No') . "</p>";
echo "<p>Versión de la aplicación: " . Configuracion::VERSION . "</p>";

echo "<hr>";

// ---

## Expresiones

echo "<h2>Expresiones</h2>";

// Una expresión es cualquier cosa que tiene un valor.
$x = 10; // 10 es una expresión
$y = $x + 5; // $x + 5 es una expresión
$esMayor = ($y > 10); // ($y > 10) es una expresión que devuelve un booleano
$resultadoFuncion = strlen("PHP"); // strlen("PHP") es una expresión

echo "<p>Valor de Y: $y</p>";
echo "<p>¿Es Y mayor que 10? " . ($esMayor ? 'Sí' : 'No') . "</p>";
echo "<p>Longitud de 'PHP': $resultadoFuncion</p>";

echo "<hr>";

// ---

## Operadores

echo "<h2>Operadores</h2>";

$num1 = 20;
$num2 = 5;

// Aritméticos
echo "<p>Suma: " . ($num1 + $num2) . "</p>";
echo "<p>Resta: " . ($num1 - $num2) . "</p>";
echo "<p>Multiplicación: " . ($num1 * $num2) . "</p>";
echo "<p>División: " . ($num1 / $num2) . "</p>";
echo "<p>Módulo: " . ($num1 % $num2) . "</p>";
echo "<p>Exponenciación (2**3): " . (2 ** 3) . "</p>";

// Asignación
$a = 10;
$a += 5; // $a ahora es 15
echo "<p>Asignación (a+=5): $a</p>";

// Comparación
echo "<p>Igualdad (10 == '10'): " . (10 == '10' ? 'true' : 'false') . "</p>"; // true
echo "<p>Identidad (10 === '10'): " . (10 === '10' ? 'true' : 'false') . "</p>"; // false
echo "<p>Nave espacial (10 <=> 5): " . (10 <=> 5) . "</p>"; // 1 (mayor)

// Lógicos
$p = true;
$q = false;
echo "<p>AND (p && q): " . ($p && $q ? 'true' : 'false') . "</p>"; // false
echo "<p>OR (p || q): " . ($p || $q ? 'true' : 'false') . "</p>";   // true

// Cadena
$str1 = "Hola";
$str2 = " Mundo";
echo "<p>Concatenación: " . ($str1 . $str2) . "</p>";

// Fusión de Null (Null Coalescing Operator - PHP 7.0+)
$nombreUsuario = $_GET['usuario'] ?? 'Invitado';
echo "<p>Usuario (con ??): $nombreUsuario</p>";

// Operador Nullsafe (PHP 8.0+)
class Usuario {
    public ?string $nombre = null;
    public function getNombre(): ?string { return $this->nombre; }
}
$user = new Usuario();
echo "<p>Nombre con nullsafe: " . ($user?->getNombre() ?? 'Sin nombre') . "</p>"; // Sin nombre
$user->nombre = "Alice";
echo "<p>Nombre con nullsafe (set): " . ($user?->getNombre() ?? 'Sin nombre') . "</p>"; // Alice

echo "<hr>";

// ---

## Estructuras de Control

echo "<h2>Estructuras de Control</h2>";

// If-Elseif-Else
$edad = 18;
if ($edad < 12) {
    echo "<p>Eres un niño.</p>";
} elseif ($edad < 18) {
    echo "<p>Eres un adolescente.</p>";
} else {
    echo "<p>Eres un adulto.</p>";
}

// Switch
$dia = "Lunes";
switch ($dia) {
    case "Lunes":
        echo "<p>Es el primer día de la semana.</p>";
        break;
    case "Viernes":
        echo "<p>Casi fin de semana.</p>";
        break;
    default:
        echo "<p>Día normal.</p>";
}

// While
echo "<p>Bucle While:</p>";
$i = 0;
while ($i < 3) {
    echo $i . " ";
    $i++;
}
echo "</p>";

// Do-While
echo "<p>Bucle Do-While:</p>";
$j = 0;
do {
    echo $j . " ";
    $j++;
} while ($j < 3);
echo "</p>";

// For
echo "<p>Bucle For:</p>";
for ($k = 0; $k < 5; $k++) {
    if ($k == 2) continue; // Salta esta iteración
    echo $k . " ";
    if ($k == 4) break; // Termina el bucle
}
echo "</p>";

// Foreach
echo "<p>Bucle Foreach:</p>";
$frutas = ["Manzana", "Banana", "Cereza"];
foreach ($frutas as $fruta) {
    echo $fruta . " ";
}
echo "</p>";

echo "<hr>";

// ---

## Funciones

echo "<h2>Funciones</h2>";

// Función simple sin parámetros
function saludarMundo() {
    echo "<p>¡Hola, mundo desde una función!</p>";
}
saludarMundo();

// Función con parámetros y valor de retorno
function sumar($num1, $num2) {
    return $num1 + $num2;
}
$resultadoSuma = sumar(7, 3);
echo "<p>La suma de 7 y 3 es: $resultadoSuma</p>";

// Función anónima (Closure)
$multiplicar = function($a, $b) {
    return $a * $b;
};
echo "<p>Multiplicación con función anónima (4*5): " . $multiplicar(4, 5) . "</p>";

// Arrow Function (PHP 7.4+)
$restar = fn($x, $y) => $x - $y;
echo "<p>Resta con Arrow Function (10-3): " . $restar(10, 3) . "</p>";

echo "<hr>";

// ---

## Clases y Objetos

echo "<h2>Clases y Objetos</h2>";

// Definición de una clase
class Animal {
    // Propiedades
    public $especie;
    protected $nombre;
    private $edad;

    // Constructor
    public function __construct($especie, $nombre, $edad) {
        $this->especie = $especie;
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    // Método público
    public function hacerSonido() {
        return "El " . $this->especie . " hace un sonido.";
    }

    // Método protegido
    protected function obtenerNombre() {
        return $this->nombre;
    }

    // Método privado
    private function obtenerEdad() {
        return $this->edad;
    }

    // Método público para acceder a métodos protegidos/privados
    public function obtenerInfoCompleta() {
        return "Nombre: " . $this->obtenerNombre() . ", Especie: " . $this->especie . ", Edad: " . $this->obtenerEdad();
    }
}

// Creación de un objeto (instancia de la clase)
$miPerro = new Animal("perro", "Buddy", 5);
echo "<p>" . $miPerro->hacerSonido() . "</p>"; // Acceso a propiedad pública
echo "<p>Mi perro: " . $miPerro->especie . "</p>";
echo "<p>" . $miPerro->obtenerInfoCompleta() . "</p>";

// Herencia
class Gato extends Animal {
    public function hacerSonido() {
        return "El " . $this->especie . " maúlla.";
    }
}

$miGato = new Gato("gato", "Luna", 3);
echo "<p>" . $miGato->hacerSonido() . "</p>"; // Polimorfismo: método sobreescrito
echo "<p>" . $miGato->obtenerInfoCompleta() . "</p>";

echo "<hr>";

// ---

## Espacios de Nombres (Namespaces)

echo "<h2>Espacios de Nombres (Namespaces)</h2>";

// Declara un namespace
namespace MiAplicacion\Utilidades;

class Validador {
    public static function esEmailValido(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

// Declara otro namespace
namespace MiAplicacion\Modelos;

class Usuario {
    public $email;
    public function __construct(string $email) {
        // Para usar una clase de otro namespace, se puede hacer con el nombre completo
        // o con una declaración 'use' al inicio del archivo o bloque.
        if (\MiAplicacion\Utilidades\Validador::esEmailValido($email)) {
            $this->email = $email;
        } else {
            $this->email = "email_invalido@dominio.com";
        }
    }
}

// Para usar las clases desde el script principal (o desde otro namespace)
use MiAplicacion\Utilidades\Validador;
use MiAplicacion\Modelos\Usuario;

$emailValido = "test@example.com";
$emailInvalido = "email-invalido";

echo "<p>¿'$emailValido' es un email válido? " . (Validador::esEmailValido($emailValido) ? 'Sí' : 'No') . "</p>";
echo "<p>¿'$emailInvalido' es un email válido? " . (Validador::esEmailValido($emailInvalido) ? 'Sí' : 'No') . "</p>";

$user1 = new Usuario($emailValido);
$user2 = new Usuario($emailInvalido);
echo "<p>Email del usuario 1: " . $user1->email . "</p>";
echo "<p>Email del usuario 2: " . $user2->email . "</p>"; // Mostrará el email inválido

// Volver al namespace global para el resto del script
namespace {

echo "<hr>";

// ---

## Enumeraciones (Enums - PHP 8.1+)

echo "<h2>Enumeraciones (Enums - PHP 8.1+)</h2>";

// Definición de una enumeración
enum EstadoOrden: string {
    case Pendiente = 'PENDING';
    case Enviada = 'SHIPPED';
    case Entregada = 'DELIVERED';
    case Cancelada = 'CANCELED';

    // Métodos en Enums (a partir de PHP 8.1)
    public function esFinal(): bool {
        return in_array($this, [self::Entregada, self::Cancelada]);
    }
}

$miOrdenEstado = EstadoOrden::Pendiente;
echo "<p>Estado de la orden: " . $miOrdenEstado->value . "</p>";

$ordenEntregada = EstadoOrden::Entregada;
echo "<p>¿La orden entregada es final? " . ($ordenEntregada->esFinal() ? 'Sí' : 'No') . "</p>";
echo "<p>¿La orden pendiente es final? " . ($miOrdenEstado->esFinal() ? 'Sí' : 'No') . "</p>";

echo "<hr>";

// ---

## Errores y Excepciones

echo "<h2>Errores y Excepciones</h2>";

// Manejo de errores básico (generalmente configurado en php.ini)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Excepciones
function divisionSegura(int $dividendo, int $divisor): float {
    if ($divisor === 0) {
        // Lanzar una excepción si el divisor es cero
        throw new Exception("No se puede dividir por cero.");
    }
    return $dividendo / $divisor;
}

try {
    echo "<p>División segura (10/2): " . divisionSegura(10, 2) . "</p>";
    echo "<p>Intento de división por cero:</p>";
    echo divisionSegura(10, 0); // Esto lanzará una excepción
} catch (Exception $e) {
    echo "<p>Error capturado: " . $e->getMessage() . "</p>";
} finally {
    echo "<p>Bloque 'finally' siempre se ejecuta.</p>";
}

echo "<hr>";

// ---

## Fibras (Fibers - PHP 8.1+)

echo "<h2>Fibras (Fibers - PHP 8.1+)</h2>";
echo "<p>Las fibras permiten pausar y reanudar la ejecución de una función, útil para concurrencia ligera.</p>";

$fiber = new Fiber(function (): void {
    echo "Dentro de la fibra: paso 1\n";
    Fiber::suspend('valor_desde_fibra_1'); // Pausar y devolver un valor

    echo "Dentro de la fibra: paso 2\n";
    Fiber::suspend('valor_desde_fibra_2');

    echo "Dentro de la fibra: final\n";
});

echo "<p>Inicio del script principal</p>";

$resultado1 = $fiber->start(); // Iniciar la fibra y obtener el primer valor suspendido
echo "<p>Script principal: " . $resultado1 . "</p>";

if ($fiber->isSuspended()) {
    $resultado2 = $fiber->resume('reanudando_1'); // Reanudar la fibra y pasarle un valor
    echo "<p>Script principal: " . $resultado2 . "</p>";
}

if ($fiber->isSuspended()) {
    $fiber->resume('reanudando_2');
}

echo "<p>Fin del script principal</p>";

echo "<hr>";

// ---

## Generadores (Generators)

echo "<h2>Generadores</h2>";
echo "<p>Los generadores permiten crear iteradores de forma sencilla, ahorrando memoria al producir valores bajo demanda.</p>";

function generarNumeros($inicio, $fin) {
    for ($i = $inicio; $i <= $fin; $i++) {
        yield $i; // 'yield' devuelve un valor sin terminar la función
    }
}

echo "<p>Números generados:</p><p>";
foreach (generarNumeros(1, 5) as $numero) {
    echo $numero . " ";
}
echo "</p>";

echo "<hr>";

// ---

## Atributos (Attributes - PHP 8.0+)

echo "<h2>Atributos (Attributes - PHP 8.0+)</h2>";
echo "<p>Los atributos permiten añadir metadatos declarativos a clases, métodos, propiedades, etc.</p>";

// Definir un atributo personalizado
#[Attribute] // El atributo Attribute marca a esta clase como un atributo
class Descripcion {
    public function __construct(public string $texto) {}
}

#[Descripcion("Esta es una clase de ejemplo para demostrar atributos.")]
class ClaseConAtributo {
    #[Descripcion("Este es un método de ejemplo.")]
    public function metodoConAtributo(): string {
        return "Hola desde el método!";
    }
}

// Para leer los atributos, se usa la Reflection API
$reflectionClass = new ReflectionClass(ClaseConAtributo::class);
$classAttributes = $reflectionClass->getAttributes(Descripcion::class);

foreach ($classAttributes as $attribute) {
    $instance = $attribute->newInstance();
    echo "<p>Atributo de Clase: " . $instance->texto . "</p>";
}

$reflectionMethod = $reflectionClass->getMethod('metodoConAtributo');
$methodAttributes = $reflectionMethod->getAttributes(Descripcion::class);

foreach ($methodAttributes as $attribute) {
    $instance = $attribute->newInstance();
    echo "<p>Atributo de Método: " . $instance->texto . "</p>";
}

echo "<hr>";

// ---

## Referencias

echo "<h2>Referencias</h2>";
echo "<p>Las referencias permiten que dos variables apunten al mismo valor en memoria.</p>";

$valorOriginal = 100;
$referencia = &$valorOriginal; // $referencia es un alias de $valorOriginal

echo "<p>Valor original: $valorOriginal</p>";
echo "<p>Valor de la referencia: $referencia</p>";

$referencia = 200; // Al cambiar $referencia, también cambia $valorOriginal
echo "<p>Valor original después de cambiar referencia: $valorOriginal</p>";

unset($referencia); // Romper la referencia (no destruye $valorOriginal)
// $referencia ya no existe como alias, pero $valorOriginal sigue siendo 200

echo "<hr>";

// ---

## Variables Predefinidas (Superglobales)

echo "<h2>Variables Predefinidas (Superglobales)</h2>";
echo "<p>Estas variables están disponibles en todos los ámbitos del script.</p>";

echo "<p>Nombre del script actual: " . $_SERVER['PHP_SELF'] . "</p>";
echo "<p>Método de la petición: " . $_SERVER['REQUEST_METHOD'] . "</p>";

// Ejemplo de $_GET (si se accede como: apuntes.php?nombre=Visitante)
$nombreVisitante = $_GET['nombre'] ?? 'Invitado';
echo "<p>Bienvenido: $nombreVisitante (ejemplo de \$_GET)</p>";

// Otros ejemplos (comentar si no se usan para evitar warnings si no están definidas)
// echo "<p>Variables de entorno (PATH): " . $_ENV['PATH'] . "</p>";
// var_dump($_SESSION); // Requiere session_start()
// var_dump($_COOKIE);
// var_dump($_POST); // Si se envía un formulario POST

echo "<hr>";

// ---

## Excepciones Predefinidas

echo "<h2>Excepciones Predefinidas</h2>";
echo "<p>PHP tiene un conjunto de clases de excepción y error incorporadas.</p>";

try {
    // Ejemplo de TypeError (PHP 7+)
    // intval("no_es_un_numero"); // Esto no lanza TypeError, es un warning.
    // Para TypeError real, intenta pasar un tipo incorrecto a una función con declaración de tipo estricta.
    // declare(strict_types=1);
    // function ejemploTypeError(int $param) {}
    // ejemploTypeError("abc"); // Esto lanzaría TypeError

    // Un ejemplo simple que podría lanzar una excepción:
    $arr = [1, 2, 3];
    echo $arr[5]; // Esto generaría un Notice, no una excepción por defecto.
    // Pero si se usa un Error Handler personalizado o se convierte en excepción...
    throw new InvalidArgumentException("¡Un argumento no es válido!");

} catch (TypeError $e) {
    echo "<p>Capturado un TypeError: " . $e->getMessage() . "</p>";
} catch (InvalidArgumentException $e) {
    echo "<p>Capturado un InvalidArgumentException: " . $e->getMessage() . "</p>";
} catch (Exception $e) {
    echo "<p>Capturada una Excepción general: " . $e->getMessage() . "</p>";
}

echo "<hr>";

// ---

## Interfaces y Clases Predefinidas

echo "<h2>Interfaces y Clases Predefinidas</h2>";
echo "<p>PHP incluye numerosas interfaces y clases útiles.</p>";

// Clase DateTime
$fechaActual = new DateTime();
echo "<p>Fecha y hora actual: " . $fechaActual->format('Y-m-d H:i:s') . "</p>";

// Interfaz JsonSerializable (permite a un objeto ser serializado a JSON)
class Producto implements JsonSerializable {
    public string $nombre;
    public float $precio;

    public function __construct(string $nombre, float $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
    }

    public function jsonSerialize(): mixed {
        return [
            'product_name' => $this->nombre,
            'product_price' => $this->precio
        ];
    }
}

$miProducto = new Producto("Laptop", 1200.50);
echo "<p>Producto serializado a JSON: " . json_encode($miProducto) . "</p>";

echo "<hr>";

// ---

## Atributos Predefinidos

echo "<h2>Atributos Predefinidos</h2>";
echo "<p>PHP tiene algunos atributos internos, como `#[ReturnTypeWillChange]`.</p>";

// #[ReturnTypeWillChange] (Usado por PHP para indicar que un método puede cambiar su tipo de retorno
// en una clase interna cuando se extiende, y para silenciar errores de compatibilidad en versiones antiguas).
// No es algo que un usuario típico use directamente para sus propias clases,
// pero es un ejemplo de un atributo integrado.

// Ejemplo conceptual (no se ejecuta directamente, solo ilustra su uso)
/*
interface Stringable {
    public function __toString(): string;
}

class MyClass implements Stringable {
    #[ReturnTypeWillChange] // Esto silenciaría un warning si __toString cambiara su tipo en futuras versiones
    public function __toString() {
        return "Soy una instancia de MyClass";
    }
}
*/
echo "<p>El atributo predefinido `#[ReturnTypeWillChange]` se usa internamente para compatibilidad de tipos en interfaces y clases internas de PHP.</p>";


echo "<hr>";

// ---

## Opciones y Parámetros de Contexto

echo "<h2>Opciones y Parámetros de Contexto</h2>";
echo "<p>Permiten configurar el comportamiento de los streams (ej. HTTP, FTP).</p>";

// Ejemplo para una petición HTTP (no se ejecutará realmente si se accede desde un archivo local
// sin un servidor web que pueda hacer peticiones salientes).
$options = [
    'http' => [
        'method' => 'GET',
        'header' => "User-Agent: MiAplicacionPHP/1.0\r\n" .
                    "Accept: application/json\r\n",
        'timeout' => 5 // Timeout de 5 segundos
    ]
];
$context = stream_context_create($options);

// Intentar leer contenido de una URL externa (¡puede fallar si no hay conexión o la URL no existe!)
// Comentar la siguiente línea si no quieres que el script intente una conexión externa
// $jsonContent = @file_get_contents('https://jsonplaceholder.typicode.com/todos/1', false, $context);

// if ($jsonContent !== false) {
//     echo "<p>Contenido de JSON de ejemplo (con contexto): " . htmlspecialchars($jsonContent) . "</p>";
// } else {
//     echo "<p>No se pudo obtener el contenido JSON (puede que sea por restricciones de red o la URL).</p>";
// }

echo "<p>Ejemplo de uso de contexto para `file_get_contents`.</p>";

echo "<hr>";

// ---

## Protocolos y Envolturas Soportados (Wrappers)

echo "<h2>Protocolos y Envolturas Soportados</h2>";
echo "<p>PHP puede acceder a diferentes fuentes de datos como si fueran archivos.</p>";

// file:// - Acceso al sistema de archivos local
echo "<p>Contenido de este archivo (primeras 100 caracteres con file_get_contents):</p><pre>" . htmlspecialchars(substr(file_get_contents(__FILE__), 0, 200)) . "...</pre>";

// php:// - Streams internos
echo "<p>Contenido de php://input (vacío en una petición GET simple): " . file_get_contents("php://input") . "</p>";
file_put_contents("php://stdout", "<p>Escrito directamente en la salida estándar (php://stdout).</p>");

// data:// - Datos incrustados
echo '<p>Imagen desde data:// wrapper: <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Píxel transparente"></p>';

// http:// y https:// (ya ejemplificado con file_get_contents y contexto)
// zip:// - Acceder a archivos dentro de un zip
// echo "<p>Contenido de archivo.txt dentro de un zip: " . file_get_contents("zip:///ruta/a/mi_archivo.zip#archivo.txt") . "</p>";

echo "<hr>";
echo "<p>Fin del documento de apuntes de PHP.</p>";

} // Cierre del namespace global
?>
