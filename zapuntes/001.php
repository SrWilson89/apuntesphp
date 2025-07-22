<?php
/*
 * =============================================
 * ARCHIVO PHP COMPLETO PARA PRINCIPIANTES
 * =============================================
 * Este archivo contiene ejemplos funcionales de todos los conceptos básicos de PHP
 * con manejo de errores y organización mejorada.
 */

// Configuración para mostrar errores (útil durante el desarrollo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// =============================================
// 1. COMENTARIOS EN PHP
// =============================================

// Comentario de una línea

# Otro comentario de una línea (estilo shell)

/*
  Comentario multilínea
  que abarca varias líneas
*/

/**
 * Comentario de documentación (DocBlock)
 * @param string $nombre Nombre del usuario
 * @return string Saludo personalizado
 */

// =============================================
// 2. VARIABLES EN PHP
// =============================================

// Variables básicas
$nombre = "María";     // String
$edad = 30;            // Integer
$altura = 1.65;        // Float
$activo = true;        // Boolean

// Mostrando variables
echo "<h2>Variables</h2>";
echo "Nombre: $nombre, Edad: $edad<br>";

// =============================================
// 3. ECHO/PRINT
// =============================================

echo "<h2>Echo/Print</h2>";
echo "Usando echo para mostrar texto<br>";
print "Usando print para mostrar texto<br>";

// Diferencia entre comillas simples y dobles
echo 'Variable $nombre no se interpreta<br>';
echo "Variable $nombre sí se interpreta<br>";

// =============================================
// 4. TIPOS DE DATOS
// =============================================

echo "<h2>Tipos de Datos</h2>";

// Tipos escalares
$entero = 42;
$flotante = 3.14;
$cadena = "Hola";
$booleano = true;

// Tipo compuesto (array)
$lenguajes = ["PHP", "JavaScript", "Python"];

// Mostrando tipos
echo "Tipo de \$entero: " . gettype($entero) . "<br>";
echo "Tipo de \$cadena: " . gettype($cadena) . "<br>";

// =============================================
// 5. CADENAS DE TEXTO (STRINGS)
// =============================================

echo "<h2>Manipulación de Cadenas</h2>";

$texto = "Aprendiendo PHP";

// Funciones comunes
echo "Longitud: " . strlen($texto) . "<br>";
echo "Mayúsculas: " . strtoupper($texto) . "<br>";
echo "Reemplazo: " . str_replace("PHP", "programación", $texto) . "<br>";

// =============================================
// 6. NÚMEROS Y OPERACIONES MATEMÁTICAS
// =============================================

echo "<h2>Números y Matemáticas</h2>";

$num1 = 15;
$num2 = 4;

// Operaciones básicas
echo "Suma: " . ($num1 + $num2) . "<br>";
echo "Resta: " . ($num1 - $num2) . "<br>";
echo "Multiplicación: " . ($num1 * $num2) . "<br>";
echo "División: " . ($num1 / $num2) . "<br>";
echo "Módulo: " . ($num1 % $num2) . "<br>";

// Funciones matemáticas
echo "Potencia: " . pow($num1, 2) . "<br>";
echo "Raíz cuadrada: " . sqrt($num1) . "<br>";
echo "Número aleatorio: " . rand(1, 100) . "<br>";

// =============================================
// 7. CONSTANTES
// =============================================

echo "<h2>Constantes</h2>";

define("PI", 3.1416);
const VERSION = "7.4";

echo "Valor de PI: " . PI . "<br>";
echo "Versión de PHP: " . VERSION . "<br>";

// Constantes mágicas
echo "Línea actual: " . __LINE__ . "<br>";
echo "Archivo actual: " . __FILE__ . "<br>";

// =============================================
// 8. OPERADORES
// =============================================

echo "<h2>Operadores</h2>";

$x = 10;
$y = 5;

echo "Igualdad: " . ($x == $y) . "<br>";      // 0 (false)
echo "Desigualdad: " . ($x != $y) . "<br>";   // 1 (true)
echo "Mayor que: " . ($x > $y) . "<br>";      // 1 (true)

// Operadores lógicos
$esMayor = ($x > $y) && ($y > 0); // AND
echo "Es mayor y positivo: " . $esMayor . "<br>";

// =============================================
// 9. ESTRUCTURAS DE CONTROL
// =============================================

echo "<h2>Estructuras de Control</h2>";

// If-elseif-else
$nota = 75;

if ($nota >= 90) {
    echo "Excelente<br>";
} elseif ($nota >= 70) {
    echo "Bueno<br>";
} else {
    echo "Necesitas mejorar<br>";
}

// Switch
$dia = "martes";

switch($dia) {
    case "lunes":
        echo "Comienza la semana<br>";
        break;
    case "viernes":
        echo "¡Fin de semana!<br>";
        break;
    default:
        echo "Día normal de trabajo<br>";
}

// =============================================
// 10. BUCLES (LOOPS)
// =============================================

echo "<h2>Bucles</h2>";

// Bucle for
echo "Conteo: ";
for($i = 1; $i <= 5; $i++) {
    echo $i . " ";
}
echo "<br>";

// Bucle while
$j = 5;
echo "Cuenta regresiva: ";
while($j > 0) {
    echo $j . " ";
    $j--;
}
echo "<br>";

// Bucle foreach
$colores = ["rojo", "verde", "azul"];
echo "Colores: ";
foreach($colores as $color) {
    echo $color . " ";
}
echo "<br>";

// =============================================
// 11. FUNCIONES
// =============================================

echo "<h2>Funciones</h2>";

// Función básica
function saludar($nombre) {
    return "Hola, $nombre!";
}

echo saludar("Carlos") . "<br>";

// Función con valor por defecto
function sumar($a, $b = 10) {
    return $a + $b;
}

echo "Suma: " . sumar(5, 3) . "<br>";     // 8
echo "Suma con default: " . sumar(5) . "<br>"; // 15

// =============================================
// 12. ARRAYS
// =============================================

echo "<h2>Arrays</h2>";

// Array indexado
$frutas = ["manzana", "banana", "naranja"];
echo "Segunda fruta: " . $frutas[1] . "<br>";

// Array asociativo
$persona = [
    "nombre" => "Ana",
    "edad" => 25,
    "profesion" => "desarrolladora"
];
echo "Nombre: " . $persona["nombre"] . "<br>";

// Funciones de arrays
echo "Número de frutas: " . count($frutas) . "<br>";
sort($frutas);
echo "Frutas ordenadas: " . implode(", ", $frutas) . "<br>";

// =============================================
// 13. SUPERGLOBALES
// =============================================

echo "<h2>Superglobales (simuladas)</h2>";

// Simulamos datos para el ejemplo
$_GET = ['id' => 123, 'busqueda' => 'php'];
$_POST = ['usuario' => 'admin', 'clave' => 'secret'];
$_SERVER['SERVER_NAME'] = 'localhost';

echo "ID de GET: " . ($_GET['id'] ?? 'No definido') . "<br>";
echo "Usuario de POST: " . ($_POST['usuario'] ?? 'No definido') . "<br>";
echo "Servidor: " . $_SERVER['SERVER_NAME'] . "<br>";

// =============================================
// 14. EXPRESIONES REGULARES
// =============================================

echo "<h2>Expresiones Regulares</h2>";

$correo = "usuario@example.com";

if (preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $correo)) {
    echo "El correo $correo es válido<br>";
} else {
    echo "El correo $correo no es válido<br>";
}

// =============================================
// EJEMPLO FINAL INTEGRADO
// =============================================

echo "<h2>Ejemplo Integrado</h2>";

function calcularEdad($fechaNacimiento) {
    $hoy = new DateTime();
    $nacimiento = new DateTime($fechaNacimiento);
    $diferencia = $hoy->diff($nacimiento);
    return $diferencia->y;
}

$usuarios = [
    ["nombre" => "Laura", "fecha_nac" => "1990-05-15"],
    ["nombre" => "Pedro", "fecha_nac" => "1985-11-22"],
    ["nombre" => "Marta", "fecha_nac" => "1998-03-08"]
];

echo "<ul>";
foreach($usuarios as $usuario) {
    $edad = calcularEdad($usuario["fecha_nac"]);
    $clase = ($edad >= 30) ? "adulto" : "joven";
    echo "<li class='$clase'>{$usuario['nombre']} tiene $edad años</li>";
}
echo "</ul>";
?>

<style>
    body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
    h2 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 5px; }
    .adulto { color: #e74c3c; }
    .joven { color: #2ecc71; }
    ul { list-style-type: none; padding: 0; }
    li { padding: 5px; margin: 3px 0; background: #f8f9fa; }
</style>