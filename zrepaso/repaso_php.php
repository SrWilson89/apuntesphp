<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Ejercicios PHP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f9f9f9;
        }

        /* Menú lateral */
        .sidebar {
            width: 280px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.2);
            overflow-y: auto;
            box-sizing: border-box;
        }

        .sidebar-title {
            text-align: center;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #ecf0f1;
            border-bottom: 1px solid #34495e;
        }

        .menu-item {
            display: block;
            color: #bdc3c7;
            padding: 12px 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 5px solid transparent;
        }

        .menu-item:hover {
            background-color: #34495e;
            color: white;
            border-left: 5px solid #3498db;
        }

        .menu-item.active {
            background-color: #34495e;
            color: white;
            border-left: 5px solid #3498db;
            font-weight: bold;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            width: calc(100% - 280px);
            box-sizing: border-box;
        }

        /* Estilos para las secciones de contenido */
        .content-section {
            background-color: white;
            padding: 25px 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-left: 6px solid #3498db;
        }

        h1 {
            color: #0056b3;
            text-align: center;
            margin-bottom: 40px;
        }

        h2 {
            color: #2c3e50;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        h3 {
            color: #007bff;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        pre {
            background-color: #e9e9e9;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-family: "Courier New", Courier, monospace;
            font-size: 0.9em;
            line-height: 1.5;
            position: relative;
        }

        .code-filename {
            position: absolute;
            top: 5px;
            right: 10px;
            background-color: #6c757d;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.8em;
        }

        .result-box {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .warning-box {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        p {
            line-height: 1.6;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: disc;
            margin-left: 20px;
            margin-bottom: 10px;
        }

        ol {
            list-style-type: decimal;
            margin-left: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-title">Contenidos PHP</div>
        <a href="#summary" class="menu-item">Resumen General</a>
        <a href="#file001" class="menu-item">001.php: Fundamentos Básicos</a>
        <a href="#file002" class="menu-item">002.php: Ejercicios Varios</a>
        <a href="#file003" class="menu-item">003.php: Estructuras de Control I</a>
        <a href="#file004" class="menu-item">004.php: Estructuras de Control II</a>
        <a href="#file005" class="menu-item">005.php: Funciones</a>
        <a href="#file006" class="menu-item">006.php: Más Funciones</a>
        <a href="#file007" class="menu-item">007.php: Superglobales y Formularios</a>
        <a href="#file008" class="menu-item">008.php: Expresiones Regulares</a>
        <a href="#file009" class="menu-item">009.php: Manejo de Formularios</a>
        <a href="#file010" class="menu-item">010.php: Gestión de Logs</a>
    </div>

    <div class="main-content">
        <h1>Resumen de Archivos PHP</h1>

        <div id="summary" class="content-section">
            <h2>Resumen General</h2>
            <p>Estos archivos PHP cubren una amplia gama de conceptos fundamentales y avanzados del lenguaje, ideales para principiantes e intermedios. Se abordan desde la sintaxis básica hasta la interacción con el sistema y el manejo de datos complejos.</p>
            <ul>
                <li>**Fundamentos (001.php):** Introducción a comentarios, variables, tipos de datos, operadores y estructuras básicas como `echo` y `print`.</li>
                <li>**Estructuras de Control (003.php, 004.php):** Demostraciones detalladas de condicionales (`if`, `else`, `elseif`, `switch`) y bucles (`while`, `do-while`, `for`, `foreach`), incluyendo ejemplos prácticos con arrays.</li>
                <li>**Funciones (005.php, 006.php):** Creación y uso de funciones con y sin argumentos, valores de retorno, argumentos por defecto y argumentos por referencia. También se incluyen ejercicios comunes de funciones como cálculo de factorial, área, y palindromía.</li>
                <li>**Variables Superglobales (007.php):** Explicación y uso de las variables superglobales de PHP (`$_GET`, `$_POST`, `$_REQUEST`, `$_SERVER`, `$_FILES`, `$_COOKIE`, `$_SESSION`, `$_ENV`, `$GLOBALS`) para interactuar con el entorno del servidor, datos de usuario y estados de sesión.</li>
                <li>**Expresiones Regulares (008.php):** Introducción a las expresiones regulares PCRE en PHP con ejemplos de `preg_match`, `preg_match_all`, `preg_replace`, `preg_split`, y `preg_grep`.</li>
                <li>**Manejo de Formularios (009.php):** Ejemplos prácticos de procesamiento de formularios HTML utilizando los métodos GET y POST, incluyendo la subida de archivos.</li>
                <li>**Gestión de Logs (010.php):** Implementación de una función sencilla para escribir mensajes en un archivo de log, útil para depuración y monitoreo de aplicaciones.</li>
                <li>**Ejercicios Variados (002.php):** Una colección de ejercicios prácticos que refuerzan conceptos como manipulación de strings, variables, arrays y clases.</li>
            </ul>
        </div>

        <div id="file001" class="content-section">
            <h2>001.php: Fundamentos Básicos de PHP</h2>
            <p>Este archivo introduce los conceptos más fundamentales de PHP, desde la configuración de errores hasta la manipulación básica de datos y la declaración de constantes.</p>
            <pre><span class="code-filename">001.php</span>
&lt;?php
/*
 * =============================================
 * ARCHIVO PHP COMPLETO PARA PRINCIPIANTES
 * =============================================
 * Este archivo contiene ejemplos funcionales de todos los conceptos básicos de PHP
 * con manejo de errores y organización mejorada.
 */

// Configuración para mostrar errores (útil durante el desarrollo)
error_reporting(E_ALL); // Habilita todos los informes de errores
ini_set('display_errors', 1); // Muestra los errores directamente en la página

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
$nombre = "María";     // Variable de tipo String
$edad = 30;            // Variable de tipo Integer
$altura = 1.65;        // Variable de tipo Float
$activo = true;        // Variable de tipo Boolean

// Mostrando variables
echo "&lt;h2&gt;Variables&lt;/h2&gt;";
echo "Nombre: $nombre, Edad: $edad&lt;br&gt;"; // Las comillas dobles permiten la interpolación de variables

// =============================================
// 3. ECHO/PRINT
// =============================================

echo "&lt;h2&gt;Echo/Print&lt;/h2&gt;";
echo "Usando echo para mostrar texto&lt;br&gt;";
print "Usando print para mostrar texto&lt;br&gt;";

// Diferencia entre comillas simples y dobles
echo 'Variable $nombre no se interpreta&lt;br&gt;'; // Las comillas simples no interpretan variables
echo "Variable $nombre sí se interpreta&lt;br&gt;"; // Las comillas dobles sí interpretan variables

// =============================================
// 4. TIPOS DE DATOS
// =============================================

echo "&lt;h2&gt;Tipos de Datos&lt;/h2&gt;";

// Tipos escalares
$entero = 42;
$flotante = 3.14;
$cadena = "Hola";
$booleano = true;

// Tipo compuesto (array)
$lenguajes = ["PHP", "JavaScript", "Python"]; // Array indexado

// Mostrando tipos usando gettype()
echo "Tipo de \$entero: " . gettype($entero) . "&lt;br&gt;";
echo "Tipo de \$cadena: " . gettype($cadena) . "&lt;br&gt;";

// =============================================
// 5. CADENAS DE TEXTO (STRINGS)
// =============================================

echo "&lt;h2&gt;Manipulación de Cadenas&lt;/h2&gt;";
$texto = "Aprendiendo PHP";

// Funciones comunes de strings
echo "Longitud: " . strlen($texto) . "&lt;br&gt;"; // Calcula la longitud de la cadena
echo "Mayúsculas: " . strtoupper($texto) . "&lt;br&gt;"; // Convierte a mayúsculas
echo "Reemplazo: " . str_replace("PHP", "programación", $texto) . "&lt;br&gt;"; // Reemplaza una subcadena por otra

// =============================================
// 6. OPERADORES
// =============================================

echo "&lt;h2&gt;Operadores&lt;/h2&gt;";

// Operadores aritméticos
$num1 = 10;
$num2 = 3;
echo "Suma: " . ($num1 + $num2) . "&lt;br&gt;";
echo "Resta: " . ($num1 - $num2) . "&lt;br&gt;";
echo "Multiplicación: " . ($num1 * $num2) . "&lt;br&gt;";
echo "División: " . ($num1 / $num2) . "&lt;br&gt;";
echo "Módulo: " . ($num1 % $num2) . "&lt;br&gt;";

// Operadores de asignación
$x = 10;
$x += 5; // $x = $x + 5
echo "Asignación +=: " . $x . "&lt;br&gt;";

// Operadores de comparación
$a = 10;
$b = "10";
echo "Igual (==): " . ($a == $b ? "Verdadero" : "Falso") . "&lt;br&gt;"; // Compara valor
echo "Idéntico (===): " . ($a === $b ? "Verdadero" : "Falso") . "&lt;br&gt;"; // Compara valor y tipo

// Operadores lógicos
$cond1 = true;
$cond2 = false;
echo "AND (&&): " . ($cond1 && $cond2 ? "Verdadero" : "Falso") . "&lt;br&gt;";
echo "OR (||): " . ($cond1 || $cond2 ? "Verdadero" : "Falso") . "&lt;br&gt;";

// =============================================
// 7. CONSTANTES
// =============================================

echo "&lt;h2&gt;Constantes&lt;/h2&gt;";

// Definir una constante
define("MI_CONSTANTE", "Este es un valor constante");
echo "Valor de la constante: " . MI_CONSTANTE . "&lt;br&gt;";

// Las constantes no pueden ser redefinidas y no usan el símbolo $
// define("MI_CONSTANTE", "Nuevo Valor"); // Esto generaría un error

// Constantes predefinidas (ejemplo)
echo "Versión de PHP: " . PHP_VERSION . "&lt;br&gt;";
echo "Sistema Operativo: " . PHP_OS . "&lt;br&gt;";

// =============================================
// 8. ARRAY (ARREGLOS)
// =============================================

echo "&lt;h2&gt;Arrays&lt;/h2&gt;";

// Array indexado
$frutas = ["Manzana", "Banana", "Cereza"];
echo "Primera fruta: " . $frutas[0] . "&lt;br&gt;";
$frutas[1] = "Plátano"; // Modificar un elemento
echo "Segunda fruta modificada: " . $frutas[1] . "&lt;br&gt;";
echo "Número de frutas: " . count($frutas) . "&lt;br&gt;";

// Array asociativo
$persona = [
    "nombre" => "Juan",
    "edad" => 30,
    "ciudad" => "Madrid"
];
echo "Nombre de la persona: " . $persona["nombre"] . "&lt;br&gt;";
$persona["edad"] = 31; // Modificar un elemento
echo "Nueva edad: " . $persona["edad"] . "&lt;br&gt;";

// Array multidimensional (array de arrays)
$alumnos = [
    ["nombre" => "Ana", "nota" => 9],
    ["nombre" => "Luis", "nota" => 7]
];
echo "Nota de Ana: " . $alumnos[0]["nota"] . "&lt;br&gt;";

// =============================================
// EJEMPLO FINAL INTEGRADO
// =============================================

echo "&lt;h2&gt;Ejemplo Integrado&lt;/h2&gt;";

// Función para calcular la edad a partir de la fecha de nacimiento
function calcularEdad($fechaNacimiento) {
    $hoy = new DateTime(); // Obtiene la fecha actual
    $nacimiento = new DateTime($fechaNacimiento); // Crea un objeto DateTime a partir de la fecha de nacimiento
    $diferencia = $hoy->diff($nacimiento); // Calcula la diferencia entre las dos fechas
    return $diferencia->y; // Retorna los años de diferencia
}

// Validación de correo electrónico usando expresiones regulares (introducción)
$correo = "usuario@example.com";
// Comprueba si el formato del correo es válido.
// ^[a-zA-Z0-9._-]+@ : Comienza con letras, números, ., _, - seguido de un @
// [a-zA-Z0-9.-]+ : Continúa con letras, números, ., -
// \.[a-zA-Z]{2,}$ : Termina con un . y al menos dos letras (dominio)
if (preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/", $correo)) {
    echo "El correo $correo es válido&lt;br&gt;";
} else {
    echo "El correo $correo no es válido&lt;br&gt;";
}

$usuarios = [
    ["nombre" => "Laura", "fecha_nac" => "1990-05-15"],
    ["nombre" => "Pedro", "fecha_nac" => "1985-11-22"],
    ["nombre" => "Marta", "fecha_nac" => "1998-03-08"]
];

echo "&lt;ul&gt;";
foreach($usuarios as $usuario) {
    $edad = calcularEdad($usuario["fecha_nac"]); // Calcula la edad para cada usuario
    $clase = ($edad >= 30) ? "adulto" : "joven"; // Asigna una clase CSS según la edad
    echo "&lt;li class=\"$clase\"&gt;" . $usuario["nombre"] . " tiene " . $edad . " años.&lt;/li&gt;";
}
echo "&lt;/ul&gt;";

?&gt;
            </pre>
        </div>

        <div id="file002" class="content-section">
            <h2>002.php: Ejercicios PHP Varios</h2>
            <p>Este archivo contiene una serie de ejercicios prácticos que abarcan desde el manejo de variables y strings hasta la implementación de clases y conversiones de tipos, utilizando una estructura HTML predefinida para una mejor visualización de los resultados.</p>
            <pre><span class="code-filename">002.php</span>
&lt;?php
// Estilos CSS para el menú lateral y el contenido principal.
// Este bloque de PHP está incrustando HTML y CSS para dar formato a la página.
echo '
&lt;!DOCTYPE html&gt;
&lt;html lang="es"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Ejercicios PHP&lt;/title&gt;
    &lt;style&gt;
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f9f9f9;
        }

        /* Menú lateral */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            height: 100vh;
            position: fixed;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
        }

        .sidebar-title {
            text-align: center;
            padding: 10px;
            margin-bottom: 30px;
            font-size: 22px;
            font-weight: bold;
            color: #ecf0f1;
            border-bottom: 1px solid #34495e;
        }

        .menu-item {
            display: block;
            color: #bdc3c7;
            padding: 12px 20px;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .menu-item:hover {
            background-color: #34495e;
            color: white;
            border-left: 4px solid #3498db;
        }

        .menu-item.active {
            background-color: #34495e;
            color: white;
            border-left: 4px solid #3498db;
        }

        /* Contenido principal */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            width: calc(100% - 250px);
        }

        /* Estilos para los ejercicios */
        .exercise-container {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border-left: 5px solid #3498db;
        }

        .exercise-title {
            color: #2c3e50;
            margin-top: 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .back-to-top {
            display: inline-block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
        }

        .back-to-top:hover {
            text-decoration: underline;
        }

        /* Estilos para las salidas de PHP */
        pre {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #eee;
            overflow-x: auto;
        }

        .code-block {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            font-family: Consolas, Monaco, "Courier New", monospace;
            margin: 10px 0;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
';

// Menú lateral HTML structure
echo '
&lt;div class="sidebar"&gt;
    &lt;div class="sidebar-title"&gt;Ejercicios PHP&lt;/div&gt;
    &lt;a href="#ej1" class="menu-item"&gt;1. Variables básicas&lt;/a&gt;
    &lt;a href="#ej2" class="menu-item"&gt;2. Suma variables&lt;/a&gt;
    &lt;a href="#ej3" class="menu-item"&gt;3. Longitud string&lt;/a&gt;
    &lt;a href="#ej4" class="menu-item"&gt;4. Tipos de variables&lt;/a&gt;
    &lt;a href="#ej5" class="menu-item"&gt;5. Contar palabras&lt;/a&gt;
    &lt;a href="#ej6" class="menu-item"&gt;6. Variable local&lt;/a&gt;
    &lt;a href="#ej7" class="menu-item"&gt;7. Variables globales&lt;/a&gt;
    &lt;a href="#ej8" class="menu-item"&gt;8. Variable static&lt;/a&gt;
    &lt;a href="#ej9" class="menu-item"&gt;9. String a número&lt;/a&gt;
    &lt;a href="#ej10" class="menu-item"&gt;10. Conversiones&lt;/a&gt;
    &lt;a href="#ej11" class="menu-item"&gt;11. Reemplazar texto&lt;/a&gt;
    &lt;a href="#ej12" class="menu-item"&gt;12. Trim&lt;/a&gt;
    &lt;a href="#ej13" class="menu-item"&gt;13. Explode&lt;/a&gt;
    &lt;a href="#ej14" class="menu-item"&gt;14. Concatenación&lt;/a&gt;
    &lt;a href="#ej15" class="menu-item"&gt;15. Substring&lt;/a&gt;
    &lt;a href="#ej16" class="menu-item"&gt;16. Array coches&lt;/a&gt;
    &lt;a href="#ej17" class="menu-item"&gt;17. Mayor y menor&lt;/a&gt;
    &lt;a href="#ej18" class="menu-item"&gt;18. Clase Persona&lt;/a&gt;
    &lt;a href="#ej19" class="menu-item"&gt;19. Propiedad privada&lt;/a&gt;
    &lt;a href="#ej20" class="menu-item"&gt;20. Conversiones&lt;/a&gt;
    &lt;a href="#ej21" class="menu-item"&gt;21. Dominio email&lt;/a&gt;
&lt;/div&gt;

&lt;div class="main-content"&gt;
';

// Función auxiliar para envolver cada ejercicio en un contenedor HTML.
// Esto ayuda a organizar la presentación de cada ejercicio con su título y contenido.
function wrapExercise($content, $number, $title = '') {
    // Si no se proporciona un título, se genera uno por defecto.
    if (empty($title)) {
        $title = "Ejercicio $number";
    }
    // Retorna la estructura HTML para el ejercicio.
    return '
    &lt;div id="ej'.$number.'" class="exercise-container"&gt;
        &lt;h2 class="exercise-title"&gt;Ejercicio '.$number.': '.$title.'&lt;/h2&gt;
        '.$content.'
        &lt;a href="#" class="back-to-top"&gt;&amp;uarr; Volver arriba&lt;/a&gt;
    &lt;/div&gt;
    ';
}

// Ejercicio 1: Variables básicas
// Demuestra la declaración y visualización de variables de diferentes tipos.
ob_start(); // Inicia la captura de salida
$texto = "Hola Mundo";
$numero = 123;
$booleano = true;
echo '&lt;div class="code-block"&gt;$texto = "Hola Mundo";&lt;br&gt;$numero = 123;&lt;br&gt;$booleano = true;&lt;/div&gt;';
echo "&lt;p&gt;Texto: $texto&lt;/p&gt;";
echo "&lt;p&gt;Número: $numero&lt;/p&gt;";
echo "&lt;p&gt;Booleano: " . ($booleano ? "Verdadero" : "Falso") . "&lt;/p&gt;";
$output = ob_get_clean(); // Finaliza la captura y obtiene el contenido
echo wrapExercise($output, 1, 'Variables básicas');

// Ejercicio 2: Suma de variables
// Muestra cómo realizar una operación aritmética simple y visualizar el resultado.
ob_start();
$a = 5;
$b = 10;
$suma = $a + $b;
echo '&lt;div class="code-block"&gt;$a = 5;&lt;br&gt;$b = 10;&lt;br&gt;$suma = $a + $b;&lt;/div&gt;';
echo "&lt;p&gt;La suma de $a y $b es: $suma&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 2, 'Suma de variables');

// Ejercicio 3: Longitud de un string
// Utiliza la función strlen() para obtener la longitud de una cadena.
ob_start();
$cadena = "Programación PHP";
$longitud = strlen($cadena);
echo '&lt;div class="code-block"&gt;$cadena = "Programación PHP";&lt;br&gt;$longitud = strlen($cadena);&lt;/div&gt;';
echo "&lt;p&gt;La longitud de la cadena es: $longitud&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 3, 'Longitud de un string');

// Ejercicio 4: Tipos de variables
// Demuestra el uso de gettype() y var_dump() para inspeccionar tipos de datos.
ob_start();
$entero = 100;
$decimal = 10.5;
$texto_var = "Hola";
$es_verdad = false;
echo '&lt;div class="code-block"&gt;$entero = 100;&lt;br&gt;$decimal = 10.5;&lt;br&gt;$texto_var = "Hola";&lt;br&gt;$es_verdad = false;&lt;/div&gt;';
echo '&lt;p&gt;Tipo de $entero: ' . gettype($entero) . '&lt;/p&gt;';
echo '&lt;p&gt;Tipo de $decimal: ' . gettype($decimal) . '&lt;/p&gt;';
echo '&lt;p&gt;Tipo de $texto_var: ' . gettype($texto_var) . '&lt;/p&gt;';
echo '&lt;p&gt;Tipo de $es_verdad: ' . gettype($es_verdad) . '&lt;/p&gt;';
echo '&lt;p&gt;var_dump de $entero:&lt;/p&gt;&lt;pre&gt;'; var_dump($entero); echo '&lt;/pre&gt;';
$output = ob_get_clean();
echo wrapExercise($output, 4, 'Tipos de variables');

// Ejercicio 5: Contar palabras en un string
// Utiliza str_word_count() para contar las palabras.
ob_start();
$frase = "Este es un ejemplo de frase.";
$num_palabras = str_word_count($frase);
echo '&lt;div class="code-block"&gt;$frase = "Este es un ejemplo de frase.";&lt;br&gt;$num_palabras = str_word_count($frase);&lt;/div&gt;';
echo "&lt;p&gt;La frase tiene $num_palabras palabras.&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 5, 'Contar palabras en un string');

// Ejercicio 6: Variables locales
// Demuestra el ámbito de las variables dentro y fuera de una función.
ob_start();
function miFuncion() {
    $local_var = "Soy una variable local.";
    echo "&lt;p&gt;Dentro de la función: $local_var&lt;/p&gt;";
}
miFuncion();
// echo "&lt;p&gt;Fuera de la función: $local_var&lt;/p&gt;"; // Esto causaría un error
echo '&lt;div class="code-block"&gt;function miFuncion() { $local_var = "Soy una variable local."; echo "$local_var"; }&lt;br&gt;miFuncion();&lt;/div&gt;';
echo "&lt;p&gt;Variables locales solo existen dentro de la función donde son declaradas.&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 6, 'Variables locales');

// Ejercicio 7: Variables globales
// Muestra cómo acceder a variables globales dentro de una función usando la palabra clave global.
ob_start();
$global_var = "Soy una variable global.";
function otraFuncion() {
    global $global_var;
    echo "&lt;p&gt;Dentro de la función (global): $global_var&lt;/p&gt;";
}
otraFuncion();
echo '&lt;div class="code-block"&gt;$global_var = "Soy una variable global.";&lt;br&gt;function otraFuncion() { global $global_var; echo "$global_var"; }&lt;br&gt;otraFuncion();&lt;/div&gt;';
echo "&lt;p&gt;Fuera de la función: $global_var&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 7, 'Variables globales');

// Ejercicio 8: Variables estáticas
// Demuestra el comportamiento de las variables estáticas que mantienen su valor entre llamadas a funciones.
ob_start();
function contador() {
    static $cuenta = 0; // Se inicializa solo la primera vez
    $cuenta++;
    echo "&lt;p&gt;El contador es: $cuenta&lt;/p&gt;";
}
contador(); // 1
contador(); // 2
contador(); // 3
echo '&lt;div class="code-block"&gt;function contador() { static $cuenta = 0; $cuenta++; echo "$cuenta"; }&lt;br&gt;contador(); //1&lt;br&gt;contador(); //2&lt;br&gt;contador(); //3&lt;/div&gt;';
$output = ob_get_clean();
echo wrapExercise($output, 8, 'Variables estáticas');

// Ejercicio 9: Conversión de string a número
// Muestra cómo PHP convierte automáticamente un string a número en operaciones aritméticas.
ob_start();
$str_num = "100";
$total = $str_num + 50; // PHP convierte "$str_num" a un número
echo '&lt;div class="code-block"&gt;$str_num = "100";&lt;br&gt;$total = $str_num + 50;&lt;/div&gt;';
echo "&lt;p&gt;Suma de string y número: $total&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 9, 'Conversión de string a número');

// Ejercicio 10: Conversiones de tipo explícitas (casting)
// Demuestra cómo se puede forzar la conversión de un tipo de dato a otro.
ob_start();
$var_string = "123.45";
$int_cast = (int)$var_string;
$float_cast = (float)$var_string;
$bool_cast = (bool)$int_cast;
echo '&lt;div class="code-block"&gt;$var_string = "123.45";&lt;br&gt;$int_cast = (int)$var_string;&lt;br&gt;$float_cast = (float)$var_string;&lt;br&gt;$bool_cast = (bool)$int_cast;&lt;/div&gt;';
echo "&lt;p&gt;String original: $var_string&lt;/p&gt;";
echo "&lt;p&gt;Convertido a int: $int_cast (Tipo: " . gettype($int_cast) . ")&lt;/p&gt;";
echo "&lt;p&gt;Convertido a float: $float_cast (Tipo: " . gettype($float_cast) . ")&lt;/p&gt;";
echo "&lt;p&gt;Convertido a bool: " . ($bool_cast ? "Verdadero" : "Falso") . " (Tipo: " . gettype($bool_cast) . ")&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 10, 'Conversiones de tipo explícitas');

// Ejercicio 11: Reemplazar texto en un string
// Usa str_replace() para sustituir ocurrencias de una subcadena por otra.
ob_start();
$texto_original = "Me gusta programar en Java.";
$texto_modificado = str_replace("Java", "PHP", $texto_original);
echo '&lt;div class="code-block"&gt;$texto_original = "Me gusta programar en Java.";&lt;br&gt;$texto_modificado = str_replace("Java", "PHP", $texto_original);&lt;/div&gt;';
echo "&lt;p&gt;Original: $texto_original&lt;/p&gt;";
echo "&lt;p&gt;Modificado: $texto_modificado&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 11, 'Reemplazar texto');

// Ejercicio 12: Eliminar espacios en blanco (trim)
// Demuestra el uso de trim(), ltrim() y rtrim() para eliminar espacios en blanco.
ob_start();
$texto_espacios = "   Hola Mundo   ";
$trimmed_texto = trim($texto_espacios);
$ltrimmed_texto = ltrim($texto_espacios);
$rtrimmed_texto = rtrim($texto_espacios);
echo '&lt;div class="code-block"&gt;$texto_espacios = "   Hola Mundo   ";&lt;br&gt;$trimmed_texto = trim($texto_espacios);&lt;br&gt;$ltrimmed_texto = ltrim($texto_espacios);&lt;br&gt;$rtrimmed_texto = rtrim($texto_espacios);&lt;/div&gt;';
echo "&lt;p&gt;Original: '$texto_espacios'&lt;/p&gt;";
echo "&lt;p&gt;Trimmed: '$trimmed_texto'&lt;/p&gt;";
echo "&lt;p&gt;L-Trimmed: '$ltrimmed_texto'&lt;/p&gt;";
echo "&lt;p&gt;R-Trimmed: '$rtrimmed_texto'&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 12, 'Eliminar espacios en blanco (trim)');

// Ejercicio 13: Dividir un string en un array (explode)
// Utiliza explode() para dividir una cadena en un array basándose en un delimitador.
ob_start();
$csv_data = "manzana,pera,uva,platano";
$frutas_array = explode(",", $csv_data);
echo '&lt;div class="code-block"&gt;$csv_data = "manzana,pera,uva,platano";&lt;br&gt;$frutas_array = explode(",", $csv_data);&lt;/div&gt;';
echo "&lt;p&gt;Array de frutas:&lt;/p&gt;&lt;pre&gt;"; print_r($frutas_array); echo "&lt;/pre&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 13, 'Dividir un string en un array (explode)');

// Ejercicio 14: Concatenación de strings
// Demuestra diferentes formas de unir cadenas de texto.
ob_start();
$parte1 = "Hola";
$parte2 = "Mundo";
$saludo = $parte1 . " " . $parte2;
$saludo_alt = "$parte1 $parte2";
echo '&lt;div class="code-block"&gt;$parte1 = "Hola";&lt;br&gt;$parte2 = "Mundo";&lt;br&gt;$saludo = $parte1 . " " . $parte2;&lt;br&gt;$saludo_alt = "$parte1 $parte2";&lt;/div&gt;';
echo "&lt;p&gt;Saludo 1: $saludo&lt;/p&gt;";
echo "&lt;p&gt;Saludo 2: $saludo_alt&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 14, 'Concatenación de strings');

// Ejercicio 15: Substring
// Extrae una parte de un string usando substr().
ob_start();
$lorem = "Lorem ipsum dolor sit amet.";
$sub = substr($lorem, 6, 5); // Desde la posición 6, 5 caracteres
echo '&lt;div class="code-block"&gt;$lorem = "Lorem ipsum dolor sit amet.";&lt;br&gt;$sub = substr($lorem, 6, 5);&lt;/div&gt;';
echo "&lt;p&gt;Substring: '$sub'&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 15, 'Substring');

// Ejercicio 16: Array de coches con foreach
// Itera sobre un array asociativo para mostrar información de coches.
ob_start();
$cars = [
    ["brand" => "Toyota", "model" => "Corolla", "year" => 2020],
    ["brand" => "Honda", "model" => "Civic", "year" => 2018],
    ["brand" => "Ford", "model" => "Focus", "year" => 2022]
];
echo '&lt;div class="code-block"&gt;
$cars = [
    ["brand" =&gt; "Toyota", "model" =&gt; "Corolla", "year" =&gt; 2020],
    ["brand" =&gt; "Honda", "model" =&gt; "Civic", "year" =&gt; 2018],
    ["brand" =&gt; "Ford", "model" =&gt; "Focus", "year" =&gt; 2022]
];
foreach ($cars as $car) {
    echo "&lt;p&gt;Marca: " . $car["brand"] . ", Modelo: " . $car["model"] . ", Año: " . $car["year"] . "&lt;/p&gt;";
}&lt;/div&gt;';
foreach ($cars as $car) {
    echo "&lt;p&gt;Marca: " . $car["brand"] . ", Modelo: " . $car["model"] . ", Año: " . $car["year"] . "&lt;/p&gt;";
}
$output = ob_get_clean();
echo wrapExercise($output, 16, 'Array de coches con foreach');

// Ejercicio 17: Encontrar el mayor y menor en un array
// Utiliza min() y max() para encontrar los valores extremos en un array numérico.
ob_start();
$numbers = [3, 1, 4, 1, 5, 9, 2, 6];
$min_val = min($numbers);
$max_val = max($numbers);
echo '&lt;div class="code-block"&gt;$numbers = [3, 1, 4, 1, 5, 9, 2, 6];&lt;br&gt;$min_val = min($numbers);&lt;br&gt;$max_val = max($numbers);&lt;/div&gt;';
echo "&lt;p&gt;Array: [" . implode(", ", $numbers) . "]&lt;/p&gt;";
echo "&lt;p&gt;Valor mínimo: $min_val&lt;/p&gt;";
echo "&lt;p&gt;Valor máximo: $max_val&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 17, 'Mayor y menor en un array');

// Ejercicio 18: Clase Persona
// Define una clase simple con propiedades y un método constructor y un método para mostrar información.
ob_start();
class Persona {
    public $nombre; // Propiedad pública
    public $edad;   // Propiedad pública

    public function __construct($nombre, $edad) {
        $this-&gt;nombre = $nombre;
        $this-&gt;edad = $edad;
    }

    public function getInfo() {
        return "Nombre: " . $this-&gt;nombre . ", Edad: " . $this-&gt;edad;
    }
}

$persona1 = new Persona("Ana", 25);
echo '&lt;div class="code-block"&gt;
class Persona {
    public $nombre;
    public $edad;
    public function __construct($nombre, $edad) { /* ... */ }
    public function getInfo() { /* ... */ }
}
$persona1 = new Persona("Ana", 25);
echo $persona1-&gt;getInfo();&lt;/div&gt;';
echo "&lt;p&gt;" . $persona1-&gt;getInfo() . "&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 18, 'Clase Persona');

// Ejercicio 19: Propiedad privada
// Demuestra el concepto de encapsulamiento con una propiedad privada y un método getter.
ob_start();
class Coche {
    private $modelo; // Propiedad privada

    public function __construct($modelo) {
        $this-&gt;modelo = $modelo;
    }

    public function getModelo() { // Método público para acceder a la propiedad privada
        return $this-&gt;modelo;
    }
}
$miCoche = new Coche("Sedan");
echo '&lt;div class="code-block"&gt;
class Coche {
    private $modelo;
    public function __construct($modelo) { /* ... */ }
    public function getModelo() { return $this-&gt;modelo; }
}
$miCoche = new Coche("Sedan");
echo $miCoche-&gt;getModelo();&lt;/div&gt;';
echo "&lt;p&gt;Modelo del coche: " . $miCoche-&gt;getModelo() . "&lt;/p&gt;";
// Intentar acceder a $miCoche->modelo directamente causaría un error
$output = ob_get_clean();
echo wrapExercise($output, 19, 'Propiedad privada');


// Ejercicio 20: Conversiones a array y objeto
// Muestra cómo se pueden castear variables escalares a arrays y objetos, y el resultado de var_dump.
ob_start(); // Inicia la captura de salida
$var_int = 8;
$var_float = 10.25;
$var_bool = true;
$var_str = "Esto es un string";
$var_null = null;

$int_array = (array) $var_int; // Castea un entero a un array
$float_array = (array) $var_float; // Castea un float a un array
$bool_array = (array) $var_bool; // Castea un booleano a un array
$str_array = (array) $var_str; // Castea un string a un array
$null_array = (array) $var_null; // Castea null a un array

echo '
&lt;div class="code-block"&gt;$var_int = 8;&lt;br&gt;$int_array = (array)$var_int;&lt;br&gt;var_dump($int_array);&lt;br&gt;var_dump((object)$int_array);&lt;/div&gt;
&lt;p&gt;Impresión cast int to array:&lt;/p&gt;
&lt;pre&gt;';
var_dump($int_array); // Muestra el contenido detallado del array resultante
echo '&lt;/pre&gt;
&lt;p&gt;Impresión cast int to array to object:&lt;/p&gt;
&lt;pre&gt;';
var_dump((object) $int_array); // Muestra el contenido detallado del objeto resultante del array
echo '&lt;/pre&gt;
';
$output = ob_get_clean(); // Finaliza la captura
echo wrapExercise($output, 20, 'Conversiones a array y objeto');

// Ejercicio 21: Obtener el dominio de un email
// Define una función para extraer el dominio de una dirección de correo electrónico.
ob_start();
function getDomain($email) {
   $pos = strpos($email, "@") + 1; // Encuentra la posición del '@' y suma 1 para empezar después
   $dominio = substr($email, $pos); // Extrae la subcadena desde esa posición hasta el final
   return $dominio;
}
$email1 = "usuario@ejemplo.com";
$email2 = "admin@miweb.org";
echo '&lt;div class="code-block"&gt;
function getDomain($email) { /* ... */ }
$email1 = "usuario@ejemplo.com";
echo getDomain($email1);&lt;/div&gt;';
echo "&lt;p&gt;Dominio de '$email1': " . getDomain($email1) . "&lt;/p&gt;";
echo "&lt;p&gt;Dominio de '$email2': " . getDomain($email2) . "&lt;/p&gt;";
$output = ob_get_clean();
echo wrapExercise($output, 21, 'Obtener el dominio de un email');

echo '&lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
';
?&gt;
            </pre>
        </div>

        <div id="file003" class="content-section">
            <h2>003.php: Estructuras de Control (Condicionales y Bucles)</h2>
            <p>Este archivo se enfoca en las estructuras de control más comunes en PHP, como las sentencias condicionales (`if`, `else`, `elseif`) y los bucles (`while`, `do-while`, `for`, `foreach`), mostrando diferentes formas de implementarlas.</p>
            <pre><span class="code-filename">003.php</span>
&lt;?php
# Ruta de referencia para el archivo.
# http://localhost/repo/unitel-RubenUnitel/012%20-%20PHP/003%20-%20Estructuras%20PHP/ejercicio.php

/**
 * ESTRUCTURAS DE CONTROL
 * Este bloque demuestra el uso de condicionales y bucles en PHP.
 */

// Condicionales

// Condicional 1: Sentencia IF simple
// Si se cumple la condición, se ejecuta el bloque de código interno.
// Sintaxis básica: if (condition) { code to be executed; }
$var1 = 10;
$var2 = 20;
$var3 = 10;

// Diferentes formas de tabular y escribir la sentencia IF.

// Forma 1: Sentencia en una sola línea (no recomendada para bloques complejos)
if ($var1 == $var2) echo "$var1 y la $var2: Son iguales"; // Esta condición es falsa
if ($var1 == $var3) echo "$var1 y la $var3: Son iguales"; // Esta condición es verdadera, se imprime.

// Forma 2: Sin llaves, solo la primera sentencia después del IF se considera parte del condicional.
// if ($var1 == $var2)
//     echo "Son iguales";
// echo "Esta sentencia no forma parte del if" // Se ejecuta siempre

// Forma 3: Con llaves, el bloque de código dentro de las llaves se ejecuta si la condición es verdadera.
// if ($var1 == $var2)
// {
//     echo "Son iguales";
// }

// Condicional 2: IF con operadores lógicos (AND, OR)
// Se pueden realizar múltiples comparaciones.
$a = 200;
$b = 33;
$c = 500;
// Condición: true AND true => true. Ambas condiciones deben ser verdaderas.
if ($a > $b && $a &lt; $c ) {
  echo "&lt;br&gt;Ambas condiciones son verdaderas";
}

// Ejemplo de comprobación de edad (ejercicio de linux)
$edad = null; // La variable edad se inicializa a null
// La condición verifica que $edad no sea null Y que sea mayor a 18.
// Si $edad es null, la primera parte de la condición ($edad != null) es falsa,
// por lo que la segunda parte no se evalúa (cortocircuito) y el bloque no se ejecuta.
if ($edad != null && $edad &gt; 18)
{
    echo "&lt;br&gt;Eres mayor de edad.";
}

// Ejemplo de condición OR
$a = 7;
// La condición es verdadera si $a es igual a 2, O 3, O 4, etc.
if ($a == 2 || $a == 3 || $a == 4 || $a == 5 || $a == 6 || $a == 7) {
  echo "&lt;br&gt;$a es un número entre 2 y 7 (usando OR)";
}

// Versión compacta y más eficiente del ejemplo anterior, usando operadores de rango.
if ($a &gt;= 2 && $a &lt;= 7) {
  echo "&lt;br&gt;$a es un número entre 2 y 7 (usando rango)";
}

// Condicional 3: IF...ELSE
// Si la condición es verdadera, se ejecuta el bloque IF; de lo contrario, se ejecuta el bloque ELSE.
// Sintaxis:
// if (condition) {
//   // código a ejecutar si la condición es verdadera;
// } else {
//   // código a ejecutar si la condición es falsa;
// }

// Ejemplo con hora del día
$t = date("H"); // Obtiene la hora actual en formato de 24 horas (00-23)

if ($t &lt; "20") { // Si la hora es menor a 20 (8 PM)
  echo "&lt;br&gt;Que tengas un buen día!";
} else { // Si la hora es 20 o más
  echo "&lt;br&gt;Que tengas una buena noche!";
}

// Condicional 4: IF...ELSEIF...ELSE
// Permite evaluar múltiples condiciones en secuencia.
// Sintaxis:
// if (condition1) {
//   // código si condition1 es verdadera;
// } elseif (condition2) {
//   // código si condition1 es falsa Y condition2 es verdadera;
// } else {
//   // código si ninguna de las condiciones anteriores es verdadera;
// }

// Ejemplo de saludo según la hora
if ($t &lt; "10") {
  echo "&lt;br&gt;Que tengas una buena mañana!";
} elseif ($t &lt; "20") {
  echo "&lt;br&gt;Que tengas un buen día!";
} else {
  echo "&lt;br&gt;Que tengas una buena noche!";
}

// Condicional 5: SWITCH
// Se utiliza para realizar diferentes acciones basadas en diferentes condiciones en una sola variable.
// Es una alternativa más limpia al uso de múltiples elseif para una misma variable.
$favcolor = "red";

switch ($favcolor) {
  case "red": // Si $favcolor es "red"
    echo "&lt;br&gt;Tu color favorito es rojo!";
    break; // Sale del switch
  case "blue": // Si $favcolor es "blue"
    echo "&lt;br&gt;Tu color favorito es azul!";
    break;
  case "green": // Si $favcolor es "green"
    echo "&lt;br&gt;Tu color favorito es verde!";
    break;
  default: // Si ninguno de los casos anteriores coincide
    echo "&lt;br&gt;Tu color favorito no es rojo, azul o verde!";
}

/**
 * BUCLES (LOOPS)
 * Los bucles se utilizan para ejecutar un bloque de código repetidamente.
 */

// Bucle WHILE
// Ejecuta un bloque de código siempre que la condición especificada sea verdadera.
$x = 1;
echo "&lt;h3&gt;Bucle While&lt;/h3&gt;";
while($x &lt;= 5) { // La condición se verifica antes de cada iteración
  echo "&lt;br&gt;El número es: $x";
  $x++; // Incrementa $x en cada iteración
}

// Bucle DO...WHILE
// Ejecuta el bloque de código al menos una vez, y luego repite siempre que la condición sea verdadera.
$x = 1;
echo "&lt;h3&gt;Bucle Do...While&lt;/h3&gt;";
do {
  echo "&lt;br&gt;El número es: $x";
  $x++;
} while ($x &lt;= 5); // La condición se verifica después de la primera iteración

// Bucle FOR
// Se utiliza cuando se sabe de antemano cuántas veces se quiere ejecutar un bloque de código.
// Sintaxis: for (inicialización; condición; incremento/decremento)
echo "&lt;h3&gt;Bucle For&lt;/h3&gt;";
for ($i = 0; $i &lt;= 10; $i++) { // Inicializa $i, verifica $i&lt;=10, luego incrementa $i
  echo "&lt;br&gt;El número es: $i";
}

// Bucle FOREACH
// Se utiliza específicamente para iterar sobre elementos de arrays.
// Sintaxis para arrays indexados: foreach (array as value)
// Sintaxis para arrays asociativos: foreach (array as key => value)

echo "&lt;h3&gt;Bucle Foreach&lt;/h3&gt;";
$colors = array("red", "green", "blue", "yellow");

foreach ($colors as $value) { // Itera sobre los valores del array $colors
  echo "&lt;br&gt;Foreach Indexado: Color: $value";
}

// Ejemplo de foreach con array asociativo
$members = array("Peter"=&gt;"35", "Ben"=&gt;"37", "Joe"=&gt;"43");
// Peter =&gt; Key
// 35 =&gt; Value

foreach ($members as $key =&gt; $value) { // Itera sobre las claves y los valores
  echo "&lt;br&gt;Foreach Asociativo. Para la llave $key, el valor es: $value";
}

// Ejemplo de array de arrays (simulando una base de datos)
$usuarios = array(
  array("id" =&gt; 0, "name" =&gt; "Peter", "age" =&gt; 35),
  array("id" =&gt; 1, "name" =&gt; "Ben", "age" =&gt; 37),
  array("id" =&gt; 2, "name" =&gt; "Joe", "age" =&gt; 43)
);

foreach ($usuarios as $user) { // Itera sobre cada sub-array (cada usuario)
  echo "&lt;br&gt;El usuario ".$user["name"]." tiene un id: ".$user["id"]." y su edad es ".$user["age"];
}

// Ejemplo con objetos (aplicable a foreach cuando se itera sobre propiedades públicas)
class Car {
  public $color;
  public $model;
  public function __construct($color, $model) {
    $this-&gt;color = $color;
    $this-&gt;model = $model;
  }
}

$myCar1 = new Car("red", "Volvo");
$myCar2 = new Car("blue", "Renault");
$myCar3 = new Car("green", "Citroen");

$coches = array($myCar1, $myCar2, $myCar3); // Array de objetos

echo "&lt;h3&gt;Foreach con Objetos&lt;/h3&gt;";
foreach ($coches as $coche) {
  // Accede a las propiedades públicas de cada objeto Car
  echo "&lt;br&gt;El coche es de color " . $coche-&gt;color . " y modelo " . $coche-&gt;model;
}

?&gt;
            </pre>
        </div>

        <div id="file004" class="content-section">
            <h2>004.php: Ejercicios de Estructuras de Control Avanzadas</h2>
            <p>Este archivo presenta ejercicios prácticos que refuerzan el uso de estructuras de control, incluyendo condicionales `if-else` y `switch`, y bucles `foreach` para manipular arrays.</p>
            <pre><span class="code-filename">004.php</span>
&lt;?php
/*
========================================
EJERCICIOS DE ESTRUCTURAS DE CONTROL EN PHP
========================================
Este archivo contiene ejercicios prácticos para comprender y aplicar las estructuras de control en PHP.
*/

echo "&lt;h1&gt;Ejercicios de Estructuras de Control en PHP&lt;/h1&gt;";

// Ejercicio 1: Verificación de edad
// Determina si una persona es mayor o menor de edad.
echo "&lt;h2&gt;1. Verificación de edad&lt;/h2&gt;";
$edad = 20;
if ($edad &gt;= 18) {
    echo "Eres mayor de edad (Edad: $edad)";
} else {
    echo "Eres menor de edad (Edad: $edad)";
}
echo "&lt;br&gt;&lt;br&gt;"; // Salto de línea para separar ejercicios

// Ejercicio 2: Evaluación de notas
// Clasifica una nota como "Aprobado" o "Suspendido".
echo "&lt;h2&gt;2. Evaluación de notas&lt;/h2&gt;";
$nota = 6;
if ($nota &gt;= 5) {
    echo "Aprobado (Nota: $nota)";
} else {
    echo "Suspendido (Nota: $nota)";
}
echo "&lt;br&gt;&lt;br&gt;";

// Ejercicio 3: Evaluación de temperatura
// Muestra un mensaje según el rango de temperatura.
echo "&lt;h2&gt;3. Evaluación de temperatura&lt;/h2&gt;";
$temperatura = 15;
if ($temperatura &lt; 0) {
    echo "Hace mucho frío ($temperatura °C)";
} elseif ($temperatura &gt;= 0 && $temperatura &lt;= 20) {
    echo "Hace fresco ($temperatura °C)";
} else {
    echo "Hace calor ($temperatura °C)";
}
echo "&lt;br&gt;&lt;br&gt;";

// Ejercicio 4: Días de la semana con switch
// Convierte un número en el día de la semana correspondiente.
echo "&lt;h2&gt;4. Días de la semana con switch&lt;/h2&gt;";
$dia = 3;
switch ($dia) {
    case 1:
        echo "Lunes";
        break;
    case 2:
        echo "Martes";
        break;
    case 3:
        echo "Miércoles"; // Se ejecuta para $dia = 3
        break;
    case 4:
        echo "Jueves";
        break;
    case 5:
        echo "Viernes";
        break;
    case 6:
        echo "Sábado";
        break;
    case 7:
        echo "Domingo";
        break;
    default:
        echo "Número de día inválido";
}
echo "&lt;br&gt;&lt;br&gt;";

// 🔢 Ejercicio 1: Sumar los elementos de un array
// Calcula la suma de todos los números en un array.
$numeros = [2, 4, 6, 8, 10];
$suma = 0;

foreach ($numeros as $num) {
    $suma += $num; // Acumula la suma
}

echo "&lt;h3&gt;Ejercicio 1: Sumar los elementos de un array&lt;/h3&gt;";
echo "La suma total es: $suma&lt;br&gt;&lt;br&gt;";

// 🔤 Ejercicio 2: Mostrar los elementos de un array asociativo
// Itera y muestra pares clave-valor de un array asociativo.
$persona = [
    "nombre" => "Laura",
    "edad" => 28,
    "ciudad" => "Toledo"
];

echo "&lt;h3&gt;Ejercicio 2: Mostrar los elementos de un array asociativo&lt;/h3&gt;";
foreach ($persona as $clave => $valor) {
    echo "$clave: $valor&lt;br&gt;";
}
echo "&lt;br&gt;";

// 🗂️ Ejercicio 3: Ordenar un array de números
// Ordena un array de números en orden ascendente usando sort().
$valores = [9, 3, 5, 1, 4];

sort($valores); // Ordena el array $valores de menor a mayor

echo "&lt;h3&gt;Ejercicio 3: Ordenar un array de números&lt;/h3&gt;";
echo "Array ordenado: ";
foreach ($valores as $v) {
    echo "$v ";
}
echo "&lt;br&gt;&lt;br&gt;";

// 📋 Ejercicio 4: Contar elementos mayores que un valor
// Cuenta cuántos elementos en un array son mayores que un valor dado.
$numeros = [15, 22, 8, 30, 10];
$contador = 0;
$valor_limite = 15;

foreach ($numeros as $num) {
    if ($num &gt; $valor_limite) {
        $contador++;
    }
}

echo "&lt;h3&gt;Ejercicio 4: Contar elementos mayores que un valor ($valor_limite)&lt;/h3&gt;";
echo "Cantidad de números mayores que $valor_limite: $contador&lt;br&gt;&lt;br&gt;";

// 🔎 Ejercicio 5: Buscar un elemento en un array
// Verifica si un elemento existe en un array.
$frutas = ["manzana", "pera", "uva", "kiwi"];
$buscar_fruta = "uva";
$encontrado = false;

foreach ($frutas as $fruta) {
    if ($fruta === $buscar_fruta) {
        $encontrado = true;
        break; // Sale del bucle una vez que se encuentra el elemento
    }
}

echo "&lt;h3&gt;Ejercicio 5: Buscar un elemento en un array&lt;/h3&gt;";
if ($encontrado) {
    echo "$buscar_fruta se encuentra en el array.&lt;br&gt;&lt;br&gt;";
} else {
    echo "$buscar_fruta NO se encuentra en el array.&lt;br&gt;&lt;br&gt;";
}

// 🟩 Ejercicio 6: Imprimir números pares
// Itera y muestra solo los números pares hasta un límite.
echo "&lt;h3&gt;Ejercicio 6: Imprimir números pares hasta 20&lt;/h3&gt;";
echo "Números pares: ";
for ($i = 2; $i &lt;= 20; $i += 2) {
    echo "$i ";
}
echo "&lt;br&gt;&lt;br&gt;";

// 🟨 Ejercicio 7: Invertir un string
// Invierte el orden de los caracteres en una cadena.
$cadena_original = "Hola Mundo";
$cadena_invertida = strrev($cadena_original); // Función strrev para invertir strings

echo "&lt;h3&gt;Ejercicio 7: Invertir un string&lt;/h3&gt;";
echo "Original: $cadena_original&lt;br&gt;";
echo "Invertida: $cadena_invertida&lt;br&gt;&lt;br&gt;";

// 🟥 Ejercicio 8: Calcular el promedio de calificaciones
// Calcula el promedio de un array de calificaciones.
$calificaciones = [85, 90, 78, 92, 88];
$total_calificaciones = array_sum($calificaciones); // Suma todos los elementos del array
$cantidad_calificaciones = count($calificaciones); // Cuenta el número de elementos
$promedio = $total_calificaciones / $cantidad_calificaciones;

echo "&lt;h3&gt;Ejercicio 8: Calcular el promedio de calificaciones&lt;/h3&gt;";
echo "Calificaciones: [" . implode(", ", $calificaciones) . "]&lt;br&gt;";
echo "El promedio es: " . number_format($promedio, 2) . "&lt;br&gt;&lt;br&gt;"; // Formatea a 2 decimales

// 🟦 Ejercicio 9: Generar una tabla de multiplicar
// Imprime la tabla de multiplicar de un número específico.
$numero_tabla = 7;

echo "&lt;h3&gt;Ejercicio 9: Tabla de multiplicar del $numero_tabla&lt;/h3&gt;";
echo "&lt;ul&gt;";
for ($i = 1; $i &lt;= 10; $i++) {
    echo "&lt;li&gt;$numero_tabla x $i = " . ($numero_tabla * $i) . "&lt;/li&gt;";
}
echo "&lt;/ul&gt;&lt;br&gt;";

// 🟪 Ejercicio 10: Contar vocales en un string
// Cuenta el número de vocales (mayúsculas y minúsculas) en una cadena.
$texto_vocales = "Programacion en PHP";
$vocales = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];
$contador_vocales = 0;

for ($i = 0; $i &lt; strlen($texto_vocales); $i++) {
    if (in_array($texto_vocales[$i], $vocales)) { // Comprueba si el carácter actual es una vocal
        $contador_vocales++;
    }
}

echo "&lt;h3&gt;Ejercicio 10: Contar vocales&lt;/h3&gt;";
echo "Texto: \"$texto_vocales\"&lt;br&gt;";
echo "Número de vocales: $contador_vocales&lt;br&gt;&lt;br&gt;";

?&gt;
            </pre>
        </div>

        <div id="file005" class="content-section">
            <h2>005.php: Funciones en PHP</h2>
            <p>Este archivo se centra en la definición y el uso de funciones en PHP, mostrando cómo crear funciones sin argumentos, con múltiples argumentos, con valores por defecto, y cómo retornar valores o pasar argumentos por referencia.</p>
            <pre><span class="code-filename">005.php</span>
&lt;?php
# Ruta de referencia para el archivo.
# http://localhost/repo/unitel-RubenUnitel/012%20-%20PHP/004%20-%20Funciones%20PHP/funciones_php.php

// FUNCIONES
// Las funciones son bloques de código reutilizables que realizan una tarea específica.

// Crear una función simple sin argumentos
function myMessage() {
  echo "&lt;br&gt;Hello world!";
}

// Llamadas a la función
myMessage();
myMessage();
myMessage();

// Argumentos/Parámetros/Params/Inputs
// Las funciones pueden aceptar argumentos (valores de entrada).
function familyName($fname) {
  echo "&lt;br&gt;El nombre es: $fname";
}

// Llamadas a la función con diferentes argumentos
familyName("Jani");
familyName("Hege");
familyName("Stale");
familyName("Kai Jim");
familyName("Borge");

// Se pueden pasar varios inputs (hasta N)
function familyName2($fname, $year) {
  echo "&lt;br&gt;$fname Refsnes. Born in $year";
}

// Llamadas a la función con múltiples argumentos
familyName2("Hege", "1975");
familyName2("Stale", "1978");
familyName2("Kai Jim", "1983");

// Argumentos por defecto (opcionales)
// Se puede asignar un valor por defecto a un parámetro, haciéndolo opcional.
function setHeight($minheight = 50) { // Si no se pasa $minheight, su valor será 50
  echo "&lt;br&gt;La altura es : $minheight";
}

setHeight(350); // Se usa el valor 350
setHeight();    // Se usa el valor por defecto de 50
setHeight(135);
setHeight(80);

// Retorno de valores (output)
// Las funciones pueden devolver cualquier tipo de dato usando la sentencia `return`.
function sum($x, $y) {
  $z = $x + $y;
  return $z; // La función devuelve la suma de $x e $y
}

echo "&lt;br&gt;5 + 10 = " . sum(5, 10);
echo "&lt;br&gt;7 + 13 = " . sum(7, 13);
echo "&lt;br&gt;2 + 4 = " . sum(2, 4);

// Retorno de un array asociativo
// Una función puede retornar un array con múltiples valores.
function sum2($valor1, $valor2) {
  $suma = $valor1 + $valor2;
  // Retorno con array asociativo, que permite acceder a los resultados por clave.
  return array("valor1" => $valor1, "valor2" => $valor2, "resultado" => $suma);
  // Retorno con array de índices: return array($valor1, $valor2, $suma);
}

// Ventaja: sólo se llama a la función una sola vez para obtener todos los valores.
$salida = sum2(5, 10); // $salida será un array
echo "&lt;br&gt;".$salida["valor1"]." + ".$salida["valor2"]." = ".$salida["resultado"];

// Desventaja: Se llama a la función 3 veces para obtener los valores individualmente,
// lo cual puede ser ineficiente si la función realiza operaciones costosas.
echo "&lt;br&gt;".sum2(7, 13)["valor1"]." + ".sum2(7, 13)["valor2"]." = ".sum2(7, 13)["resultado"];

// Argumentos referenciados (&)
// Al pasar un argumento por referencia, cualquier cambio a la variable dentro de la función
// afectará a la variable original fuera de la función.
function add_five(&$value) { // El '&' indica que $value es una referencia
  $value += 5; // Modifica la variable original
}

$num = 2;
add_five($num); // Pasa $num por referencia
echo "&lt;br&gt;El valor del argumento por referencia es: ".$num; // $num ahora es 7

// Funciones variadas
// Buenas Prácticas: Pasar un array con longitud indeterminada usando '...' (operador splat)
// El parámetro de entrada, se convierte en un array de índices.
function sumMyNumbers(...$numeros) { // $numeros será un array que contiene todos los argumentos pasados
  $suma = 0;

  // Opción 1: Sumar con bucle for (menos común para arrays dinámicos)
  // $len es la longitud del array (número de elementos que contiene)
  // $len = count($numeros);
  // for ($i = 0; $i &lt; $len; $i++) {
  //   $suma += $numeros[$i];
  // }

  // Opción 2: Sumar con bucle foreach (más idiomático para arrays)
  foreach ($numeros as $numero) {
    $suma += $numero;
  }

  return $suma;
}

echo "&lt;br&gt;La suma de 1, 2, 3 es: " . sumMyNumbers(1, 2, 3);
echo "&lt;br&gt;La suma de 10, 20, 30, 40 es: " . sumMyNumbers(10, 20, 30, 40);

?&gt;
            </pre>
        </div>

        <div id="file006" class="content-section">
            <h2>006.php: Más Ejercicios de Funciones y Pros/Contras de Tecnologías</h2>
            <p>Este archivo extiende el concepto de funciones con ejemplos más complejos como tablas de multiplicar, factorial, palíndromos y promedios. Además, incluye un análisis de ventajas y desventajas de JavaScript.</p>
            <pre><span class="code-filename">006.php</span>
&lt;?php
// ===========================================
// ARCHIVO COMPLETO DE EJERCICIOS DE FUNCIONES
// ===========================================
// Este archivo contiene una variedad de ejercicios para practicar la creación y el uso de funciones en PHP.

/**
 * 1. Función que recibe un nombre y devuelve un saludo
 * @param string $nombre El nombre de la persona a saludar.
 * @return string Un saludo personalizado.
 */
function saludar($nombre) {
    return "Hola, $nombre";
}
echo "&lt;h3&gt;1. Saludo:&lt;/h3&gt;";
echo saludar("Juan") . "&lt;br&gt;"; // Llama a la función y muestra el resultado

/**
 * 2. Función que imprime las tablas de multiplicar del 1 al 9
 * Esta función no recibe parámetros y muestra las tablas directamente.
 */
function tablasMultiplicar() {
    echo "&lt;h3&gt;2. Tablas de Multiplicar:&lt;/h3&gt;";
    for ($i = 1; $i &lt;= 9; $i++) { // Bucle para cada tabla (del 1 al 9)
        echo "&lt;h4&gt;Tabla del $i&lt;/h4&gt;";
        echo "&lt;ul&gt;";
        for ($j = 1; $j &lt;= 10; $j++) { // Bucle para los múltiplos (del 1 al 10)
            echo "&lt;li&gt;$i x $j = " . ($i * $j) . "&lt;/li&gt;";
        }
        echo "&lt;/ul&gt;";
    }
}
tablasMultiplicar(); // Llama a la función para ejecutarla

/**
 * 3. Función que calcula el factorial de un número
 * @param int $n El número del cual se calculará el factorial.
 * @return int El factorial del número.
 */
function factorial($n) {
    if ($n &lt;= 1) { // Caso base para la recursión: factorial de 0 o 1 es 1
        return 1;
    }
    return $n * factorial($n - 1); // Llamada recursiva
}
echo "&lt;h3&gt;3. Factorial:&lt;/h3&gt;";
echo "Factorial de 5: " . factorial(5) . "&lt;br&gt;"; // 5*4*3*2*1 = 120

/**
 * 4. Función que calcula el área de un rectángulo
 * @param float $base La base del rectángulo.
 * @param float $altura La altura del rectángulo.
 * @return float El área calculada.
 */
function areaRectangulo($base, $altura) {
    return $base * $altura;
}
echo "&lt;h3&gt;4. Área del Rectángulo:&lt;/h3&gt;";
echo "Área de un rectángulo con base 10 y altura 5: " . areaRectangulo(10, 5) . "&lt;br&gt;";

/**
 * 5. Función que convierte Celsius a Fahrenheit
 * @param float $celsius La temperatura en grados Celsius.
 * @return float La temperatura convertida a Fahrenheit.
 */
function celsiusToFahrenheit($celsius) {
    return ($celsius * 9/5) + 32;
}
echo "&lt;h3&gt;5. Conversión de Temperatura:&lt;/h3&gt;";
echo "25°C son " . celsiusToFahrenheit(25) . "°F&lt;br&gt;";

/**
 * 6. Función que calcula el promedio de un array de números
 * @param array $numeros Un array de números.
 * @return float El promedio de los números, o 0 si el array está vacío.
 */
function promedio($numeros) {
    if (empty($numeros)) { // Comprueba si el array está vacío para evitar división por cero
        return 0;
    }
    return array_sum($numeros) / count($numeros); // array_sum suma elementos, count cuenta elementos
}
echo "&lt;h3&gt;6. Promedio de Números:&lt;/h3&gt;";
$mis_numeros = [10, 20, 30, 40, 50];
echo "El promedio de [" . implode(", ", $mis_numeros) . "] es: " . promedio($mis_numeros) . "&lt;br&gt;";

/**
 * 7. Función que determina si un string es palíndromo
 * Un palíndromo es una palabra o frase que se lee igual de izquierda a derecha que de derecha a izquierda.
 * @param string $texto El texto a comprobar.
 * @return bool True si es palíndromo, False en caso contrario.
 */
function esPalindromo($texto) {
    // Convierte el texto a minúsculas y elimina caracteres no alfanuméricos para una comparación justa.
    $texto = strtolower(preg_replace('/[^a-z0-9]/', '', $texto));
    return $texto == strrev($texto); // Compara el texto original con su versión invertida
}
echo "&lt;h3&gt;7. Palíndromo:&lt;/h3&gt;";
echo "'Anita lava la tina' es palíndromo: " . (esPalindromo("Anita lava la tina") ? "Sí" : "No") . "&lt;br&gt;";
echo "'Hola mundo' es palíndromo: " . (esPalindromo("Hola mundo") ? "Sí" : "No") . "&lt;br&gt;";

/**
 * 8. Función que imprime una lista numerada de nombres
 * @param array $nombres Un array de strings (nombres).
 */
function listaNumerada($nombres) {
    echo "&lt;h3&gt;8. Lista Numerada de Nombres:&lt;/h3&gt;";
    echo "&lt;ol&gt;";
    foreach ($nombres as $nombre) {
        echo "&lt;li&gt;$nombre&lt;/li&gt;";
    }
    echo "&lt;/ol&gt;";
}
$mis_nombres = ["Alice", "Bob", "Charlie"];
listaNumerada($mis_nombres);

/**
 * 9. Función con parámetro opcional
 * Demuestra un parámetro con un valor por defecto.
 * @param string $mensaje El mensaje principal.
 * @param string $sufijo Un sufijo opcional, con valor por defecto.
 * @return string El mensaje completo.
 */
function funcionOpcional($mensaje, $sufijo = "!") {
    return $mensaje . $sufijo;
}
echo "&lt;h3&gt;9. Parámetro Opcional:&lt;/h3&gt;";
echo funcionOpcional("Hola") . "&lt;br&gt;";          // Usa el sufijo por defecto
echo funcionOpcional("Adiós", "...") . "&lt;br&gt;"; // Usa el sufijo proporcionado

/**
 * 10. Función con retorno de múltiples valores (usando un array)
 * Muestra cómo una función puede devolver varios datos relacionados.
 * @param int $num1 Primer número.
 * @param int $num2 Segundo número.
 * @return array Un array asociativo con la suma y la resta.
 */
function operacionesBasicas($num1, $num2) {
    return [
        'suma' => $num1 + $num2,
        'resta' => $num1 - $num2
    ];
}
echo "&lt;h3&gt;10. Retorno de Múltiples Valores:&lt;/h3&gt;";
$resultados = operacionesBasicas(10, 5);
echo "Suma: " . $resultados['suma'] . ", Resta: " . $resultados['resta'] . "&lt;br&gt;";

/**
 * 11. Función anónima (Lambda o Closure)
 * Una función sin nombre que puede ser asignada a una variable o pasada como argumento.
 */
echo "&lt;h3&gt;11. Función Anónima:&lt;/h3&gt;";
$saludarAnonimo = function($nombre) {
    echo "Hola desde función anónima, $nombre!&lt;br&gt;";
};
$saludarAnonimo("Carlos");

/**
 * 12. Arrow Function (desde PHP 7.4)
 * Una forma concisa de escribir funciones anónimas de una sola expresión.
 */
echo "&lt;h3&gt;12. Arrow Function (=&gt;):&lt;/h3&gt;";
$multiplicar = fn($a, $b) =&gt; $a * $b;
echo "5 * 3 = " . $multiplicar(5, 3) . "&lt;br&gt;";

// =============================================
// ANÁLISIS DE LENGUAJES / TECNOLOGÍAS
// =============================================
// Este es un ejemplo de contenido adicional, no directamente de PHP,
// pero que fue parte del archivo original.

echo "&lt;h2&gt;Análisis de Lenguajes / Tecnologías&lt;/h2&gt;";
echo "&lt;h3&gt;JavaScript&lt;/h3&gt;";
echo "&lt;p&gt;JavaScript (JS) es un lenguaje de programación multiparadigma que se ha convertido en el lenguaje fundamental para el desarrollo web frontend y, con Node.js, también para el backend.&lt;/p&gt;";

echo "&lt;h4&gt;Pros:&lt;/h4&gt;";
echo "&lt;ul&gt;";
echo "&lt;li&gt;&lt;strong&gt;Ubicuidad y Versatilidad:&lt;/strong&gt; Se ejecuta en el navegador (frontend), en servidores (Node.js - backend), y se puede usar para escritorio y móvil. Es el lenguaje de la web por excelencia.&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Gran Ecosistema:&lt;/strong&gt; Cuenta con un ecosistema enorme de frameworks y librerías (React, Angular, Vue, Express.js, etc.) que aceleran el desarrollo.&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Comunidad Muy Activa:&lt;/strong&gt; Una de las comunidades de desarrollo más grandes y activas, con constantes innovaciones.&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Aplicaciones Multiplataforma:&lt;/strong&gt; Con herramientas como React Native o Electron, se puede usar para desarrollar aplicaciones móviles y de escritorio.&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Rendimiento:&lt;/strong&gt; Node.js es muy eficiente para operaciones de E/S (entrada/salida) y aplicaciones en tiempo real.&lt;/li&gt;";
echo "&lt;/ul&gt;";

echo "&lt;h4&gt;Contras:&lt;/h4&gt;";
echo "&lt;ul&gt;";
echo "&lt;li&gt;&lt;strong&gt;Curva de Aprendizaje (Ecosistema):&lt;/strong&gt; Aunque el lenguaje en sí no es extremadamente complejo, el rápido cambio y la gran cantidad de herramientas, frameworks y librerías pueden ser abrumadores para los principiantes.&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Gestión de Dependencias (Node_modules):&lt;/strong&gt; El directorio &lt;code&gt;node_modules&lt;/code&gt; puede volverse muy grande y pesado.&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Manejo Asíncrono (complejidad):&lt;/strong&gt; Aunque las promesas y &lt;code&gt;async/await&lt;/code&gt; han mejorado esto, el manejo de operaciones asíncronas puede ser un desafío para los nuevos desarrolladores.&lt;/li&gt;";
echo "&lt;li&gt;&lt;strong&gt;Naturaleza \"Permisiva\":&lt;/strong&gt; En sus inicios, era menos estricto con los tipos y errores, lo que podía llevar a código con bugs difíciles de depurar (aunque TypeScript ayuda mucho con esto).&lt;/li&gt;";
echo "&lt;/ul&gt;";

echo "&lt;h4&gt;Puntuación Final: 9/10&lt;/h4&gt;";
echo "&lt;p&gt;(Su capacidad para dominar tanto el frontend como el backend, junto con su enorme ecosistema y la demanda en el mercado, lo convierten en una opción extremadamente potente y versátil para casi cualquier tipo de aplicación moderna.)&lt;/p&gt;";

?&gt;
            </pre>
        </div>

        <div id="file007" class="content-section">
            <h2>007.php: Variables Superglobales en PHP</h2>
            <p>Este archivo es una demostración exhaustiva de las variables superglobales de PHP, que permiten interactuar con datos del entorno del servidor, peticiones HTTP, sesiones, cookies, y archivos subidos.</p>
            <pre><span class="code-filename">007.php</span>
&lt;?php
// Siempre iniciar la sesión al principio si vas a usar $_SESSION
// session_start() debe ser llamada antes de cualquier salida HTML.
session_start();

// --- 1. Demostración de $_COOKIE ---
// $_COOKIE es un array asociativo que contiene todas las cookies enviadas por el cliente.
// Establecer una cookie. Las cookies se envían con las cabeceras HTTP,
// así que deben establecerse antes de cualquier salida HTML.
if (!isset($_COOKIE['mi_ejemplo_cookie'])) {
    // setcookie(nombre, valor, expiración, ruta)
    // 86400 segundos = 1 día
    setcookie('mi_ejemplo_cookie', 'Valor de prueba de cookie', time() + (86400 * 30), "/"); // Cookie válida por 30 días
    $cookie_set_message = "Cookie 'mi_ejemplo_cookie' establecida. Recarga la página para verla.";
} else {
    $cookie_set_message = "Cookie 'mi_ejemplo_cookie' ya existe o se ha establecido.";
}

// --- 2. Demostración de $_SESSION ---
// $_SESSION es un array asociativo que contiene variables de sesión disponibles para el usuario actual.
// Las variables de sesión persisten entre diferentes páginas durante la navegación de un usuario.
// Establecer una variable de sesión
if (!isset($_SESSION['contador_visitas'])) {
    $_SESSION['contador_visitas'] = 1;
} else {
    $_SESSION['contador_visitas']++;
}

// --- 3. Demostración de $_POST y $_FILES ---
// $_POST es un array asociativo de variables pasadas al script actual a través del método HTTP POST.
// $_FILES es un array asociativo de elementos subidos al script actual a través del método HTTP POST.
$post_message = '';
$file_upload_info = '';

// Comprobar si la petición HTTP es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejar datos POST
    if (!empty($_POST)) {
        $post_message = "¡Datos POST recibidos!";
        // Mostrar todos los datos POST para depuración
        // echo "&lt;pre&gt;"; print_r($_POST); echo "&lt;/pre&gt;";
    }

    // Manejar subida de archivos
    // UPLOAD_ERR_OK indica que no hubo errores durante la subida del archivo.
    if (isset($_FILES['archivo_subido']) && $_FILES['archivo_subido']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Directorio donde se guardarán los archivos.
        // Asegúrate de que esta carpeta exista y tenga permisos de escritura (chmod 0777).
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Crea el directorio si no existe
        }
        // Ruta completa del archivo en el servidor. basename() previene ataques de ruta.
        $upload_file = $upload_dir . basename($_FILES['archivo_subido']['name']);

        // Mueve el archivo temporal subido a su ubicación final.
        if (move_uploaded_file($_FILES['archivo_subido']['tmp_name'], $upload_file)) {
            $file_upload_info = "Archivo subido exitosamente: " . htmlspecialchars(basename($_FILES['archivo_subido']['name']));
        } else {
            $file_upload_info = "Error al subir el archivo.";
        }
    } else if (isset($_FILES['archivo_subido']) && $_FILES['archivo_subido']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Manejar otros posibles errores de subida
        $file_upload_info = "Error de subida: " . $_FILES['archivo_subido']['error'];
    }
}

// --- 4. Demostración de $_GET ---
// $_GET es un array asociativo de variables pasadas al script actual a través de la URL (query string).
$get_message = '';
if (!empty($_GET)) {
    $get_message = "¡Parámetros GET recibidos!";
    // Mostrar todos los datos GET para depuración
    // echo "&lt;pre&gt;"; print_r($_GET); echo "&lt;/pre&gt;";
}

// --- 5. Demostración de $_REQUEST ---
// $_REQUEST es un array asociativo que contiene los contenidos de $_GET, $_POST y $_COOKIE.
// El orden en que PHP pobla $_REQUEST depende de la configuración 'variables_order' en php.ini.
$request_message = '';
if (!empty($_REQUEST)) {
    $request_message = "¡Datos REQUEST recibidos!";
}

// --- HTML para mostrar las demostraciones ---
?&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="es"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Demostración de Variables Superglobales PHP&lt;/title&gt;
    &lt;style&gt;
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 900px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #0056b3; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 30px; }
        pre { background-color: #e9e9e9; padding: 15px; border-radius: 5px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; font-family: "Courier New", Courier, monospace; }
        .info-box { background-color: #e6f7ff; border-left: 4px solid #3498db; padding: 10px; margin-bottom: 15px; }
        form { background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-top: 20px; border: 1px solid #ddd; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="file"], input[type="submit"] { padding: 8px; margin-bottom: 10px; border-radius: 4px; border: 1px solid #ccc; }
        input[type="submit"] { background-color: #28a745; color: white; cursor: pointer; border: none; }
        input[type="submit"]:hover { background-color: #218838; }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;

    &lt;div class="container"&gt;
        &lt;h1&gt;Demostración de Variables Superglobales en PHP&lt;/h1&gt;
        &lt;p&gt;Las variables superglobales son arrays integrados que siempre están disponibles en todos los ámbitos del script.&lt;/p&gt;

        &lt;h2&gt;$_GET (Variables HTTP GET)&lt;/h2&gt;
        &lt;p&gt;Contiene las variables pasadas al script a través de la URL (query string).&lt;/p&gt;
        &lt;p class="info-box"&gt;Para probar $_GET, añade &lt;code&gt;?nombre=TuNombre&amp;ciudad=TuCiudad&lt;/code&gt; a la URL.&lt;/p&gt;
        &lt;pre&gt;&lt;?php print_r($_GET); ?&gt;&lt;/pre&gt;
        &lt;p&gt;Mensaje de $_GET: &lt;?php echo $get_message; ?&gt;&lt;/p&gt;
        &lt;?php if (isset($_GET['nombre'])) { echo "&lt;p&gt;Hola, " . htmlspecialchars($_GET['nombre']) . "!&lt;/p&gt;"; } ?&gt;

        &lt;h2&gt;$_POST (Variables HTTP POST)&lt;/h2&gt;
        &lt;p&gt;Contiene las variables pasadas al script a través del método HTTP POST, generalmente de un formulario.&lt;/p&gt;
        &lt;form action="&lt;?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?&gt;" method="post" enctype="multipart/form-data"&gt;
            &lt;label for="nombre_post"&gt;Nombre:&lt;/label&gt;
            &lt;input type="text" id="nombre_post" name="nombre_post" required&gt;&lt;br&gt;&lt;br&gt;

            &lt;label for="email_post"&gt;Email:&lt;/label&gt;
            &lt;input type="email" id="email_post" name="email_post" required&gt;&lt;br&gt;&lt;br&gt;

            &lt;label for="archivo_subido"&gt;Subir archivo:&lt;/label&gt;
            &lt;input type="file" id="archivo_subido" name="archivo_subido"&gt;&lt;br&gt;&lt;br&gt;

            &lt;input type="submit" value="Enviar por POST"&gt;
        &lt;/form&gt;
        &lt;p&gt;Mensaje de $_POST: &lt;?php echo $post_message; ?&gt;&lt;/p&gt;
        &lt;pre&gt;&lt;?php print_r($_POST); ?&gt;&lt;/pre&gt;
        &lt;p&gt;&lt;?php echo $file_upload_info; ?&gt;&lt;/p&gt;

        &lt;h2&gt;$_REQUEST (Variables HTTP Request)&lt;/h2&gt;
        &lt;p&gt;Contiene una combinación de $_GET, $_POST y $_COOKIE. Su orden depende de la configuración de PHP.&lt;/p&gt;
        &lt;pre&gt;&lt;?php print_r($_REQUEST); ?&gt;&lt;/pre&gt;
        &lt;p&gt;Mensaje de $_REQUEST: &lt;?php echo $request_message; ?&gt;&lt;/p&gt;

        &lt;h2&gt;$_SERVER (Información del Servidor y Entorno de Ejecución)&lt;/h2&gt;
        &lt;p&gt;Contiene información creada por el servidor web, cabeceras, rutas de script, etc.&lt;/p&gt;
        &lt;pre&gt;&lt;?php
            // Se muestra solo una parte de $_SERVER, ya que puede ser muy extenso.
            echo "SERVER_SOFTWARE: " . $_SERVER['SERVER_SOFTWARE'] . "\n";
            echo "REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD'] . "\n";
            echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "\n";
            if (isset($_SERVER['HTTP_USER_AGENT'])) {
                echo "HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\n";
            }
            if (isset($_SERVER['REMOTE_ADDR'])) {
                echo "REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'] . "\n";
            }
            // print_r($_SERVER); // Descomenta para ver todo el array $_SERVER
        ?&gt;&lt;/pre&gt;

        &lt;h2&gt;$_FILES (Archivos Subidos por HTTP)&lt;/h2&gt;
        &lt;p&gt;Contiene información sobre los archivos subidos al script a través de un formulario con &lt;code&gt;enctype="multipart/form-data"&lt;/code&gt;.&lt;/p&gt;
        &lt;pre&gt;&lt;?php print_r($_FILES); ?&gt;&lt;/pre&gt;
        &lt;p class="info-box"&gt;El ejemplo de subida está integrado en el formulario $_POST.&lt;/p&gt;

        &lt;h2&gt;$_COOKIE (Variables HTTP Cookie)&lt;/h2&gt;
        &lt;p&gt;Contiene las cookies enviadas por el navegador del cliente. Las cookies permiten almacenar información en el lado del cliente.&lt;/p&gt;
        &lt;pre&gt;&lt;?php print_r($_COOKIE); ?&gt;&lt;/pre&gt;
        &lt;p&gt;&lt;?php echo $cookie_set_message; ?&gt;&lt;/p&gt;
        &lt;?php if (isset($_COOKIE['mi_ejemplo_cookie'])) { echo "&lt;p&gt;Valor de la cookie: " . htmlspecialchars($_COOKIE['mi_ejemplo_cookie']) . "&lt;/p&gt;"; } ?&gt;

        &lt;h2&gt;$_SESSION (Variables de Sesión)&lt;/h2&gt;
        &lt;p&gt;Contiene variables de sesión registradas para el usuario actual. Las sesiones permiten mantener el estado de un usuario a través de múltiples páginas.&lt;/p&gt;
        &lt;pre&gt;&lt;?php print_r($_SESSION); ?&gt;&lt;/pre&gt;
        &lt;p&gt;Número de visitas: &lt;?php echo $_SESSION['contador_visitas']; ?&gt;&lt;/p&gt;
        &lt;p class="info-box"&gt;Recarga la página para ver cómo aumenta el contador de visitas.&lt;/p&gt;

        &lt;h2&gt;$_ENV (Variables de Entorno del Sistema)&lt;/h2&gt;
        &lt;p&gt;Contiene variables de entorno pasadas al script por el sistema operativo en el que se ejecuta el servidor web.&lt;/p&gt;
        &lt;p class="info-box"&gt;Nota: Esta superglobal puede estar vacía o contener pocas variables dependiendo de la configuración de tu servidor web (e.g., Apache/Nginx y PHP-FPM).&lt;/p&gt;
        &lt;pre&gt;&lt;?php print_r($_ENV); ?&gt;&lt;/pre&gt;

        &lt;h2&gt;$GLOBALS (Todas las Variables Globales Disponibles)&lt;/h2&gt;
        &lt;p&gt;
            Un array asociativo que contiene referencias a todas las variables que están actualmente definidas en el ámbito global del script. Cada superglobal (como &lt;code&gt;$_SERVER&lt;/code&gt;, &lt;code&gt;$_GET&lt;/code&gt;, etc.) es accesible también a través de &lt;code&gt;$GLOBALS&lt;/code&gt;.
        &lt;/p&gt;
        &lt;p class="info-box"&gt;Nota: Este array es muy grande ya que contiene *todas* las variables globales, incluyendo las otras superglobales. Se muestra solo una parte por brevedad.&lt;/p&gt;
        &lt;pre&gt;&lt;?php
            // Para no imprimir todo $GLOBALS, que es enorme, mostramos solo algunos ejemplos.
            echo "Ejemplo de \\$GLOBALS['$_SERVER']:\n";
            print_r($GLOBALS['_SERVER']);
            echo "\nEjemplo de \\$GLOBALS['$_GET']:\n";
            print_r($GLOBALS['_GET']);
            echo "\nEjemplo de \\$GLOBALS['$_SESSION']:\n";
            print_r($GLOBALS['_SESSION']);
            // print_r($GLOBALS); // Descomenta esta línea para ver el array $GLOBALS completo (puede ser muy largo)
        ?&gt;&lt;/pre&gt;
    &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
            </pre>
        </div>

        <div id="file008" class="content-section">
            <h2>008.php: Demostración de Expresiones Regulares (PCRE)</h2>
            <p>Este archivo es una demostración detallada de cómo usar las funciones de expresiones regulares compatibles con Perl (PCRE) en PHP, cubriendo `preg_match`, `preg_match_all`, `preg_replace`, `preg_split`, y `preg_grep`.</p>
            <pre><span class="code-filename">008.php</span>
&lt;!DOCTYPE html&gt;
&lt;html lang="es"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Demostración de Expresiones Regulares en PHP (PCRE)&lt;/title&gt;
    &lt;style&gt;
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 900px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #0056b3; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 30px; }
        h3 { color: #007bff; margin-top: 20px; }
        pre { background-color: #e9e9e9; padding: 15px; border-radius: 5px; overflow-x: auto; white-space: pre-wrap; word-wrap: break-word; font-family: "Courier New", Courier, monospace; }
        .code-block { background-color: #f0f0f0; border-left: 4px solid #6c757d; padding: 10px 15px; margin-bottom: 15px; }
        .result { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin-top: 10px; }
        .warning { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; padding: 10px; border-radius: 5px; margin-top: 10px; }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;

    &lt;div class="container"&gt;
        &lt;h1&gt;Demostración de Funciones de Expresiones Regulares en PHP (PCRE)&lt;/h1&gt;
        &lt;p&gt;Las expresiones regulares son secuencias de caracteres que forman un patrón de búsqueda. PHP utiliza las funciones PCRE (Perl Compatible Regular Expressions), que son muy potentes y flexibles.&lt;/p&gt;
        &lt;p class="warning"&gt;&lt;strong&gt;Importante:&lt;/strong&gt; Todas las funciones PCRE requieren que el patrón esté delimitado por un carácter (ej. &lt;code&gt;/patron/&lt;/code&gt;, &lt;code&gt;#patron#&lt;/code&gt;, &lt;code&gt;~patron~&lt;/code&gt;). Los modificadores (como &lt;code&gt;i&lt;/code&gt; para insensible a mayúsculas/minúsculas) se colocan después del delimitador final.&lt;/p&gt;

        &lt;h2&gt;1. &lt;code&gt;preg_match()&lt;/code&gt; - Buscar la primera coincidencia&lt;/h2&gt;
        &lt;p&gt;Realiza una búsqueda de una expresión regular y devuelve &lt;code&gt;1&lt;/code&gt; si se encuentra una coincidencia, &lt;code&gt;0&lt;/code&gt; si no, o &lt;code&gt;false&lt;/code&gt; en caso de error. Las coincidencias capturadas se guardan en un array opcional.&lt;/p&gt;
        &lt;?php
        $string = "Visita mi sitio web: ejemplo.com";
        $pattern = '/ejemplo\.com/'; // Patrón para buscar "ejemplo.com"
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$string = "Visita mi sitio web: ejemplo.com";&lt;br&gt;$pattern = \'/ejemplo\\\\.com/\'; // El punto se escapa con \\\\.&lt;br&gt;if (preg_match($pattern, $string, $matches)) { ... }&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        if (preg_match($pattern, $string, $matches)) {
            echo '&lt;div class="result"&gt;Coincidencia encontrada: ' . htmlspecialchars($matches[0]) . '&lt;/div&gt;'; // $matches[0] contiene la coincidencia completa
        } else {
            echo '&lt;div class="result"&gt;No se encontró coincidencia.&lt;/div&gt;';
        }

        echo '&lt;h3&gt;Ejemplo con grupos de captura:&lt;/h3&gt;';
        $email = "contacto@dominio.com";
        $email_pattern = '/(\w+)@([\w\.-]+)/'; // Patrón para capturar nombre de usuario y dominio
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$email = "contacto@dominio.com";&lt;br&gt;$email_pattern = \'/(\\\\w+)@([\\\\w\\\\.-]+)/\';&lt;br&gt;if (preg_match($email_pattern, $email, $parts)) { ... }&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        if (preg_match($email_pattern, $email, $parts)) {
            echo '&lt;div class="result"&gt;Usuario: ' . htmlspecialchars($parts[1]) . ', Dominio: ' . htmlspecialchars($parts[2]) . '&lt;/div&gt;'; // $parts[1] para el primer grupo, $parts[2] para el segundo
        }
        ?&gt;

        &lt;h2&gt;2. &lt;code&gt;preg_match_all()&lt;/code&gt; - Buscar todas las coincidencias&lt;/h2&gt;
        &lt;p&gt;Busca todas las ocurrencias de una expresión regular en una cadena y las devuelve en un array multidimensional.&lt;/p&gt;
        &lt;?php
        $text = "Apples and bananas, and more bananas.";
        $pattern_all = '/bananas/';
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$text = "Apples and bananas, and more bananas.";&lt;br&gt;$pattern_all = \'/bananas/\';&lt;br&gt;preg_match_all($pattern_all, $text, $all_matches);&lt;br&gt;print_r($all_matches[0]);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        $all_matches = [];
        preg_match_all($pattern_all, $text, $all_matches);
        echo '&lt;div class="result"&gt;Todas las coincidencias: &lt;pre&gt;'; print_r($all_matches[0]); echo '&lt;/pre&gt;&lt;/div&gt;'; // $all_matches[0] contiene todas las cadenas coincidentes

        echo '&lt;h3&gt;Ejemplo con modificador &lt;code&gt;i&lt;/code&gt; (insensible a mayúsculas/minúsculas):&lt;/h3&gt;';
        $phrase = "Hello world, WORLD is great!";
        $pattern_case_insensitive = '/world/i'; // 'i' para búsqueda insensible a mayúsculas/minúsculas
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$phrase = "Hello world, WORLD is great!";&lt;br&gt;$pattern_case_insensitive = \'/world/i\';&lt;br&gt;preg_match_all($pattern_case_insensitive, $phrase, $case_matches);&lt;br&gt;print_r($case_matches[0]);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        $case_matches = [];
        preg_match_all($pattern_case_insensitive, $phrase, $case_matches);
        echo '&lt;div class="result"&gt;Coincidencias (insensible a mayúsculas/minúsculas): &lt;pre&gt;'; print_r($case_matches[0]); echo '&lt;/pre&gt;&lt;/div&gt;';
        ?&gt;

        &lt;h2&gt;3. &lt;code&gt;preg_replace()&lt;/code&gt; - Reemplazar coincidencias&lt;/h2&gt;
        &lt;p&gt;Realiza una búsqueda de expresión regular y reemplaza todas las ocurrencias encontradas con una cadena de reemplazo.&lt;/p&gt;
        &lt;?php
        $quote = "The quick brown fox jumps over the lazy dog.";
        $replace_pattern = '/fox/';
        $replacement = 'cat';
        $new_quote = preg_replace($replace_pattern, $replacement, $quote);
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$quote = "The quick brown fox jumps over the lazy dog.";&lt;br&gt;$replace_pattern = \'/fox/\';&lt;br&gt;$replacement = \'cat\';&lt;br&gt;$new_quote = preg_replace($replace_pattern, $replacement, $quote);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        echo '&lt;div class="result"&gt;Original: ' . htmlspecialchars($quote) . '&lt;br&gt;Reemplazado: ' . htmlspecialchars($new_quote) . '&lt;/div&gt;';

        echo '&lt;h3&gt;Ejemplo con reemplazo de múltiples coincidencias y modificador &lt;code&gt;i&lt;/code&gt;:&lt;/h3&gt;';
        $colors_text = "Red, green, Blue, Yellow. blue is my favorite.";
        $new_colors_text = preg_replace('/blue/i', 'cyan', $colors_text);
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$colors_text = "Red, green, Blue, Yellow. blue is my favorite.";&lt;br&gt;$new_colors_text = preg_replace(\'/blue/i\', \'cyan\', $colors_text);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        echo '&lt;div class="result"&gt;Original: ' . htmlspecialchars($colors_text) . '&lt;br&gt;Reemplazado: ' . htmlspecialchars($new_colors_text) . '&lt;/div&gt;';
        ?&gt;

        &lt;h2&gt;4. &lt;code&gt;preg_split()&lt;/code&gt; - Dividir un string por una expresión regular&lt;/h2&gt;
        &lt;p&gt;Divide una cadena en un array de substrings utilizando una expresión regular como delimitador.&lt;/p&gt;
        &lt;?php
        $list = "item1, item2;item3 | item4";
        $delimiters = '/[,;|]\s*/'; // Divide por coma, punto y coma, o barra vertical, seguido de espacios opcionales
        $items = preg_split($delimiters, $list);
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$list = "item1, item2;item3 | item4";&lt;br&gt;$delimiters = \'/[,;|]\\\\s*/\';&lt;br&gt;$items = preg_split($delimiters, $list);&lt;br&gt;print_r($items);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        echo '&lt;div class="result"&gt;Elementos divididos: &lt;pre&gt;'; print_r($items); echo '&lt;/pre&gt;&lt;/div&gt;';
        ?&gt;

        &lt;h2&gt;5. &lt;code&gt;preg_grep()&lt;/code&gt; - Filtrar elementos de un array por una expresión regular&lt;/h2&gt;
        &lt;p&gt;Devuelve un array que contiene solo los elementos del array de entrada que coinciden con el patrón dado.&lt;/p&gt;
        &lt;?php
        $cities = ["London", "Paris", "New York", "Los Angeles", "Rome"];
        $city_pattern = '/^L/'; // Ciudades que empiezan con 'L'
        $filtered_cities = preg_grep($city_pattern, $cities);
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$cities = ["London", "Paris", "New York", "Los Angeles", "Rome"];&lt;br&gt;$city_pattern = \'/^L/\';&lt;br&gt;$filtered_cities = preg_grep($city_pattern, $cities);&lt;br&gt;print_r($filtered_cities);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        echo '&lt;div class="result"&gt;Ciudades que empiezan con "L": &lt;pre&gt;'; print_r($filtered_cities); echo '&lt;/pre&gt;&lt;/div&gt;';

        echo '&lt;h3&gt;Ejemplo con el flag &lt;code&gt;PREG_GREP_INVERT&lt;/code&gt; (excluir coincidencias):&lt;/h3&gt;';
        $no_l_cities = preg_grep($city_pattern, $cities, PREG_GREP_INVERT); // Excluye las que empiezan con 'L'
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;$no_l_cities = preg_grep($city_pattern, $cities, PREG_GREP_INVERT);&lt;br&gt;print_r($no_l_cities);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        echo '&lt;div class="result"&gt;Ciudades que NO empiezan con "L": &lt;pre&gt;'; print_r($no_l_cities); echo '&lt;/pre&gt;&lt;/div&gt;';
        ?&gt;

        &lt;h2&gt;6. Modificadores de Expresiones Regulares&lt;/h2&gt;
        &lt;p&gt;Los modificadores se añaden al final del patrón para cambiar el comportamiento de la búsqueda.&lt;/p&gt;
        &lt;ul&gt;
            &lt;li&gt;&lt;code&gt;i&lt;/code&gt; (insensitive): Realiza una búsqueda insensible a mayúsculas/minúsculas.&lt;/li&gt;
            &lt;li&gt;&lt;code&gt;m&lt;/code&gt; (multiline): Permite que &lt;code&gt;^&lt;/code&gt; y &lt;code&gt;$&lt;/code&gt; coincidan al principio/final de cada línea, no solo al principio/final del string.&lt;/li&gt;
            &lt;li&gt;&lt;code&gt;s&lt;/code&gt; (dotall): Permite que &lt;code&gt;.&lt;/code&gt; (punto) coincida con caracteres de nueva línea.&lt;/li&gt;
            &lt;li&gt;&lt;code&gt;u&lt;/code&gt; (unicode): Habilita el manejo correcto de patrones y cadenas UTF-8. Es crucial para trabajar con caracteres acentuados, etc.&lt;/li&gt;
            &lt;li&gt;&lt;code&gt;x&lt;/code&gt; (extended): Ignora los espacios en blanco no escapados y los comentarios dentro del patrón. Facilita la legibilidad de patrones complejos.&lt;/li&gt;
        &lt;/ul&gt;

        &lt;h3&gt;Ejemplo: Coincidencia con caracteres UTF-8 (modificador &lt;code&gt;u&lt;/code&gt;)&lt;/h3&gt;
        &lt;?php
        $string_utf8 = "El café es de Düsseldorf.";
        $pattern_utf8_bad = '/\b\w+\b/i'; // Sin modificador 'u', puede fallar con caracteres especiales
        $pattern_utf8_good = '/\b\p{L}+\b/u'; // Con modificador 'u' y \p{L} para cualquier letra Unicode
        echo '&lt;p&gt;&lt;strong&gt;Cadena:&lt;/strong&gt; &lt;code&gt;' . htmlspecialchars($string_utf8) . '&lt;/code&gt;&lt;/p&gt;';
        echo '&lt;p&gt;&lt;strong&gt;Patrón sin \'u\':&lt;/strong&gt; &lt;code&gt;' . htmlspecialchars($pattern_utf8_bad) . '&lt;/code&gt;&lt;/p&gt;';
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;preg_match_all($pattern_utf8_bad, $string_utf8, $matches_bad);&lt;br&gt;print_r($matches_bad[0]);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        $matches_bad = [];
        preg_match_all($pattern_utf8_bad, $string_utf8, $matches_bad);
        echo '&lt;div class="result"&gt;Resultado sin \'u\' (puede omitir \'café\', \'Düsseldorf\'): &lt;pre&gt;'; print_r($matches_bad[0]); echo '&lt;/pre&gt;&lt;/div&gt;';

        echo '&lt;p&gt;&lt;strong&gt;Patrón con \'u\' y &lt;code&gt;\\\\p{L}&lt;/code&gt;:&lt;/strong&gt; &lt;code&gt;' . htmlspecialchars($pattern_utf8_good) . '&lt;/code&gt;&lt;/p&gt;';
        echo '&lt;div class="code-block"&gt;&lt;pre&gt;&lt;code&gt;preg_match_all($pattern_utf8_good, $string_utf8, $matches_good);&lt;br&gt;print_r($matches_good[0]);&lt;/code&gt;&lt;/pre&gt;&lt;/div&gt;';
        $matches_good = [];
        preg_match_all($pattern_utf8_good, $string_utf8, $matches_good);
        echo '&lt;div class="result"&gt;Resultado con \'u\' (maneja correctamente caracteres Unicode): &lt;pre&gt;'; print_r($matches_good[0]); echo '&lt;/pre&gt;&lt;/div&gt;';
        ?&gt;
    &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
            </pre>
        </div>

        <div id="file009" class="content-section">
            <h2>009.php: Manejo de Formularios PHP</h2>
            <p>Este archivo proporciona ejemplos prácticos para el manejo de formularios HTML en PHP, demostrando cómo procesar datos enviados por los métodos POST y GET, y cómo manejar la subida de archivos.</p>
            <pre><span class="code-filename">009.php</span>
&lt;!DOCTYPE html&gt;
&lt;html lang="es"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;
    &lt;title&gt;Demostración de Formularios PHP&lt;/title&gt;
    &lt;style&gt;
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { max-width: 800px; margin: auto; background-color: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1, h2 { color: #0056b3; border-bottom: 2px solid #eee; padding-bottom: 10px; margin-top: 30px; }
        form { background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ddd; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input[type="text"], input[type="email"], input[type="number"], textarea, select {
            width: calc(100% - 22px); /* Ancho completo menos padding y borde */
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
            width: auto; /* Ancho automático para el botón */
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .result-box {
            background-color: #e6f7ff;
            color: #0056b3;
            border: 1px solid #b3e0ff;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .error-message {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;

    &lt;div class="container"&gt;
        &lt;h1&gt;Demostración de Formularios PHP&lt;/h1&gt;
        &lt;p&gt;Este documento ilustra cómo PHP puede procesar datos enviados desde formularios HTML utilizando los métodos POST y GET.&lt;/p&gt;

        &lt;?php
        // 1. Procesamiento de formulario POST
        // Comprueba si la petición se ha enviado usando el método POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "&lt;h2&gt;Datos recibidos por POST:&lt;/h2&gt;";
            // Verifica y sanitiza los datos recibidos.
            $nombre = htmlspecialchars($_POST['nombre'] ?? 'N/A');
            $email = htmlspecialchars($_POST['email'] ?? 'N/A');
            $pais = htmlspecialchars($_POST['pais'] ?? 'N/A');
            $mensaje = htmlspecialchars($_POST['mensaje'] ?? 'N/A');
            $intereses = $_POST['intereses'] ?? []; // Los checkboxes pueden no estar definidos si no se marcan

            if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['mensaje'])) {
                echo '&lt;div class="error-message"&gt;Error: Todos los campos requeridos (Nombre, Email, Mensaje) deben ser llenados.&lt;/div&gt;';
            } else {
                echo '&lt;div class="result-box"&gt;';
                echo "&lt;p&gt;&lt;strong&gt;Nombre:&lt;/strong&gt; $nombre&lt;/p&gt;";
                echo "&lt;p&gt;&lt;strong&gt;Email:&lt;/strong&gt; $email&lt;/p&gt;";
                echo "&lt;p&gt;&lt;strong&gt;País:&lt;/strong&gt; $pais&lt;/p&gt;";
                echo "&lt;p&gt;&lt;strong&gt;Mensaje:&lt;/strong&gt; $mensaje&lt;/p&gt;";

                if (!empty($intereses)) {
                    echo "&lt;p&gt;&lt;strong&gt;Intereses:&lt;/strong&gt; " . implode(", ", array_map('htmlspecialchars', $intereses)) . "&lt;/p&gt;";
                } else {
                    echo "&lt;p&gt;&lt;strong&gt;Intereses:&lt;/strong&gt; Ninguno seleccionado.&lt;/p&gt;";
                }
                echo '&lt;/div&gt;';
            }
        }

        // 2. Procesamiento de formulario GET
        // Comprueba si la petición tiene parámetros GET.
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && (isset($_GET['query']) || isset($_GET['categoria']))) {
            echo "&lt;h2&gt;Datos recibidos por GET:&lt;/h2&gt;";
            $query = htmlspecialchars($_GET['query'] ?? '');
            $categoria = htmlspecialchars($_GET['categoria'] ?? 'Todas');

            echo '&lt;div class="result-box"&gt;';
            echo "&lt;p&gt;&lt;strong&gt;Término de búsqueda:&lt;/strong&gt; " . ($query ?: "Vacío") . "&lt;/p&gt;";
            echo "&lt;p&gt;&lt;strong&gt;Categoría:&lt;/strong&gt; " . ($categoria ?: "Todas") . "&lt;/p&gt;";
            echo '&lt;/div&gt;';
        }
        ?&gt;

        &lt;h2&gt;Formulario de Contacto (Método POST)&lt;/h2&gt;
        &lt;form action="009.php" method="POST"&gt;
            &lt;div class="form-group"&gt;
                &lt;label for="nombre"&gt;Nombre:&lt;/label&gt;
                &lt;input type="text" id="nombre" name="nombre" placeholder="Tu nombre..." required&gt;
            &lt;/div&gt;

            &lt;div class="form-group"&gt;
                &lt;label for="email"&gt;Email:&lt;/label&gt;
                &lt;input type="email" id="email" name="email" placeholder="tu.email@ejemplo.com" required&gt;
            &lt;/div&gt;

            &lt;div class="form-group"&gt;
                &lt;label&gt;Intereses:&lt;/label&gt;&lt;br&gt;
                &lt;input type="checkbox" id="interes1" name="intereses[]" value="php"&gt;
                &lt;label for="interes1"&gt;PHP&lt;/label&gt;&lt;br&gt;
                &lt;input type="checkbox" id="interes2" name="intereses[]" value="js"&gt;
                &lt;label for="interes2"&gt;JavaScript&lt;/label&gt;&lt;br&gt;
                &lt;input type="checkbox" id="interes3" name="intereses[]" value="db"&gt;
                &lt;label for="interes3"&gt;Bases de Datos&lt;/label&gt;
            &lt;/div&gt;

            &lt;div class="form-group"&gt;
                &lt;label for="pais"&gt;País:&lt;/label&gt;
                &lt;select id="pais" name="pais"&gt;
                    &lt;option value="es"&gt;España&lt;/option&gt;
                    &lt;option value="mx"&gt;México&lt;/option&gt;
                    &lt;option value="ar"&gt;Argentina&lt;/option&gt;
                    &lt;option value="cl"&gt;Chile&lt;/option&gt;
                    &lt;option value="co"&gt;Colombia&lt;/option&gt;
                    &lt;option value="ot"&gt;Otro&lt;/option&gt;
                &lt;/select&gt;
            &lt;/div&gt;

            &lt;div class="form-group"&gt;
                &lt;label for="mensaje"&gt;Mensaje:&lt;/label&gt;
                &lt;textarea id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required&gt;&lt;/textarea&gt;
            &lt;/div&gt;

            &lt;input type="submit" value="Enviar Formulario POST"&gt;
        &lt;/form&gt;

        &lt;h2&gt;Formulario de Búsqueda (Método GET)&lt;/h2&gt;
        &lt;form action="009.php" method="GET"&gt;
            &lt;div class="form-group"&gt;
                &lt;label for="query"&gt;Término de búsqueda:&lt;/label&gt;
                &lt;input type="text" id="query" name="query" placeholder="Buscar..."&gt;
            &lt;/div&gt;
            &lt;div class="form-group"&gt;
                &lt;label for="categoria"&gt;Categoría:&lt;/label&gt;
                &lt;select id="categoria" name="categoria"&gt;
                    &lt;option value=""&gt;Todas&lt;/option&gt;
                    &lt;option value="web"&gt;Desarrollo Web&lt;/option&gt;
                    &lt;option value="movil"&gt;Desarrollo Móvil&lt;/option&gt;
                    &lt;option value="datos"&gt;Ciencia de Datos&lt;/option&gt;
                &lt;/select&gt;
            &lt;/div&gt;
            &lt;input type="submit" value="Buscar con GET"&gt;
        &lt;/form&gt;

    &lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
            </pre>
        </div>

        <div id="file010" class="content-section">
            <h2>010.php: Sistema Básico de Logging</h2>
            <p>Este archivo implementa una función sencilla para escribir mensajes en un archivo de log (`app_log.txt`), que es fundamental para la depuración y el monitoreo de aplicaciones PHP.</p>
            <pre><span class="code-filename">010.php</span>
&lt;?php

// Definir el nombre del archivo de log como una constante para fácil modificación.
define('LOG_FILE', 'app_log.txt');

/**
 * Función para escribir mensajes en el archivo de log.
 *
 * @param string $message El mensaje a registrar.
 * @param string $level El nivel del log (INFO, WARNING, ERROR, DEBUG, etc.). Por defecto es 'INFO'.
 */
function writeToLog($message, $level = 'INFO') {
    // Obtener la fecha y hora actual para el timestamp del log.
    $timestamp = date('Y-m-d H:i:s');

    // Formatear el mensaje de log para incluir el timestamp y el nivel.
    // "\n" añade un salto de línea al final para que cada entrada esté en una línea nueva.
    $logMessage = "[$timestamp] [$level]: $message\n";

    // Abrir el archivo de log en modo de añadir ('a').
    // 'a' asegura que el contenido nuevo se añade al final del archivo existente.
    // Si el archivo no existe, fopen() lo creará.
    $fileHandle = fopen(LOG_FILE, 'a');

    // Verificar si el archivo se abrió correctamente.
    // Si fopen() falla (por ejemplo, debido a permisos), devuelve false.
    if ($fileHandle) {
        // Escribir el mensaje formateado en el archivo.
        fwrite($fileHandle, $logMessage);

        // Cerrar el archivo para liberar los recursos.
        fclose($fileHandle);
    } else {
        // En caso de que no se pueda abrir/escribir en el archivo de log,
        // se puede imprimir un mensaje de error en la pantalla o registrarlo de otra forma.
        // error_log() es una buena alternativa para registrar errores críticos del sistema.
        error_log("ERROR: No se pudo escribir en el archivo de log: " . LOG_FILE);
    }
}

// --- Ejemplos de uso de la función de logging ---

// Registrar un mensaje de información.
writeToLog("El usuario 'admin' ha iniciado sesión correctamente.", "INFO");

// Registrar un mensaje de advertencia.
writeToLog("Se ha detectado un intento de acceso no autorizado desde IP 192.168.1.10.", "ADVERTENCIA");

// Registrar un mensaje de error.
writeToLog("La conexión a la base de datos ha fallado. Código de error: 1045.", "ERROR");

// Registrar un mensaje con el nivel por defecto (INFO).
writeToLog("Se ha completado el proceso de importación de datos.");

?&gt;
            </pre>
        </div>
    </div>
</body>
</html>
