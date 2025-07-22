<?php
// Estilos CSS para el menú lateral
echo '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios PHP</title>
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
    </style>
</head>
<body>
';

// Menú lateral
echo '
<div class="sidebar">
    <div class="sidebar-title">Ejercicios PHP</div>
    <a href="#ej1" class="menu-item">1. Variables básicas</a>
    <a href="#ej2" class="menu-item">2. Suma variables</a>
    <a href="#ej3" class="menu-item">3. Longitud string</a>
    <a href="#ej4" class="menu-item">4. Tipos de variables</a>
    <a href="#ej5" class="menu-item">5. Contar palabras</a>
    <a href="#ej6" class="menu-item">6. Variable local</a>
    <a href="#ej7" class="menu-item">7. Variables globales</a>
    <a href="#ej8" class="menu-item">8. Variable static</a>
    <a href="#ej9" class="menu-item">9. String a número</a>
    <a href="#ej10" class="menu-item">10. Conversiones</a>
    <a href="#ej11" class="menu-item">11. Reemplazar texto</a>
    <a href="#ej12" class="menu-item">12. Trim</a>
    <a href="#ej13" class="menu-item">13. Explode</a>
    <a href="#ej14" class="menu-item">14. Concatenación</a>
    <a href="#ej15" class="menu-item">15. Substring</a>
    <a href="#ej16" class="menu-item">16. Array coches</a>
    <a href="#ej17" class="menu-item">17. Mayor y menor</a>
    <a href="#ej18" class="menu-item">18. Clase Persona</a>
    <a href="#ej19" class="menu-item">19. Propiedad privada</a>
    <a href="#ej20" class="menu-item">20. Conversiones</a>
    <a href="#ej21" class="menu-item">21. Dominio email</a>
</div>

<div class="main-content">
';

// Función para envolver cada ejercicio
function wrapExercise($content, $number, $title = '') {
    if (empty($title)) {
        $title = "Ejercicio $number";
    }
    return '
    <div id="ej'.$number.'" class="exercise-container">
        <h2 class="exercise-title">Ejercicio '.$number.': '.$title.'</h2>
        '.$content.'
        <a href="#" class="back-to-top">↑ Volver al menú</a>
    </div>';
}

// ========= EJERCICIOS ========= //

// Ejercicio 1
$nombre = "Rubén";
$edad = 30;
echo wrapExercise('
<p>Hola, me llamo '.$nombre.' y tengo '.$edad.' años</p>
<div class="code-block">$nombre = "Rubén";<br>$edad = 30;<br>echo "Hola, me llamo ".$nombre." y tengo ".$edad." años";</div>
<pre>Hola, me llamo Rubén y tengo 30 años</pre>
', 1, 'Variables básicas');

// Ejercicio 2
$x1 = 3;
$x2 = 8;
$x3 = 2;
$suma = $x1 + $x2 + $x3;
echo wrapExercise('
<p>La suma de las 3 variables es: '.$suma.'</p>
<div class="code-block">$x1 = 3;<br>$x2 = 8;<br>$x3 = 2;<br>$suma = $x1 + $x2 + $x3;<br>echo "La suma es: ".$suma;</div>
<pre>La suma de las 3 variables es: 13</pre>
', 2, 'Suma de variables');

// Ejercicio 3
$txt = "Hace un calor de morirse";
echo wrapExercise('
<p>La longitud de la cadena es: '.strlen($txt).'</p>
<div class="code-block">$txt = "Hace un calor de morirse";<br>echo "Longitud: ".strlen($txt);</div>
<pre>La longitud de la cadena es: 22</pre>
', 3, 'Longitud de string');

// Ejercicio 4
$var_int = 8;
$var_float = 10.25;
$var_bool = true;
$var_str = "Esto es un string";
$var_null = null;

ob_start(); // Inicia la captura de salida
echo '<div class="code-block">$var_int = 8;<br>$var_float = 10.25;<br>$var_bool = true;<br>$var_str = "Esto es un string";<br>$var_null = null;</div>';
echo '<p>Var int: ';
var_dump($var_int);
echo '<br> Var Float: ';
var_dump($var_float);
echo '<br> Var Bool: ';
var_dump($var_bool);
echo '<br>Var str: ';
var_dump($var_str);
echo '<br>Var null: ';
var_dump($var_null);
echo '</p>';
$output = ob_get_clean(); // Finaliza la captura

echo wrapExercise($output, 4, 'Tipos de variables');

// Ejercicio 5
$frase = "Loremp Ipsum et selem";
echo wrapExercise('
<p>La frase contiene: '.str_word_count($frase).' palabras.</p>
<div class="code-block">$frase = "Loremp Ipsum et selem";<br>echo "Palabras: ".str_word_count($frase);</div>
<pre>La frase contiene: 4 palabras.</pre>
', 5, 'Contar palabras');

// Ejercicio 6
ob_start(); // Inicia la captura de salida
echo '<div class="code-block">function myfunction6() {<br>   $var_function = "PALABRA";<br>}<br>echo $var_function; // Error</div>';
echo '<p>La variable local de la función myfunction6 es: ';
if (function_exists('myfunction6')) {
    myfunction6();
}
// Esto siempre resultará en "undefined" y el Notice si la función no retorna o asigna a una global.
// Para demostrar la variable local, la salida se simula.
echo 'undefined';
echo '<br><em>No se puede imprimir porque está fuera de su contexto.</em></p>
<pre>Notice: Undefined variable: var_function in [ruta_del_archivo] on line [número_de_línea]</pre>';
$output = ob_get_clean(); // Finaliza la captura

echo wrapExercise($output, 6, 'Variable local');

// Ejercicio 7
$x1 = 5;
$x2 = 16;
function myfunction7() {
   global $x1, $x2;
   return $x1 + $x2;
}
echo wrapExercise('
<p>La suma de las dos variables globales es: '.myfunction7().'</p>
<div class="code-block">$x1 = 5;<br>$x2 = 16;<br>function myfunction7() {<br>   global $x1, $x2;<br>   return $x1 + $x2;<br>}<br>echo myfunction7();</div>
<pre>La suma de las dos variables globales es: 21</pre>
', 7, 'Variables globales');

// Ejercicio 8
ob_start(); // Inicia la captura de salida
echo '<div class="code-block">function myfunction8() {<br>   static $contador = 0;<br>   echo "Contador: ".$contador;<br>   $contador++;<br>}<br>myfunction8();<br>myfunction8();<br>myfunction8();</div>';
function myfunction8() {
   static $contador = 0;
   echo "<p>El valor del contador es: ".$contador."</p>";
   $contador++;
}
myfunction8();
myfunction8();
myfunction8();
echo '<pre>
El valor del contador es: 0
El valor del contador es: 1
El valor del contador es: 2
</pre>';
$output = ob_get_clean(); // Finaliza la captura

echo wrapExercise($output, 8, 'Variable static');

// Ejercicio 9
$intstr = "2589";
echo wrapExercise('
<p>La variable es numérica?: '.(is_numeric($intstr) ? 'Sí' : 'No').'</p>
<p>El resultado final es: '.( (int) $intstr + 10 ).'</p>
<div class="code-block">$intstr = "2589";<br>echo is_numeric($intstr);<br>$intstr = (int)$intstr + 10;<br>echo $intstr;</div>
<pre>
La variable es numérica?: Sí
El resultado final es: 2599
</pre>
', 9, 'String a número');

// Ejercicio 10
ob_start(); // Inicia la captura de salida
$decimal = 85.98;
echo '<div class="code-block">$decimal = 85.98;<br>$entero = (int)$decimal;<br>$string = (string)$entero;</div>';
echo '<p>Tipo de 85.98 (float): ';
var_dump($decimal);
echo '<br>Tipo de 85.98 (entero): ';
$entero = (int) $decimal;
var_dump($entero);
echo '<br>Tipo de 85.98 (str): ';
$string = (string) $entero;
var_dump($string);
echo '</p>';
$output = ob_get_clean(); // Finaliza la captura

echo wrapExercise($output, 10, 'Conversiones de tipo');

// Ejercicio 11
$str = "La casa que es blanca está al fondo de la calle.";
$buscar = "blanca";
$reemplazo = str_replace($buscar, "azul", $str);
echo wrapExercise('
<p>Texto original: '.$str.'</p>
<p>La frase final es: '.$reemplazo.'</p>
<div class="code-block">$str = "La casa que es blanca...";<br>$reemplazo = str_replace("blanca", "azul", $str);<br>echo $reemplazo;</div>
<pre>La frase final es: La casa que es azul está al fondo de la calle.</pre>
', 11, 'Reemplazar texto');

// Ejercicio 12
$str_con_espacios = " Nombre ";
$str_sin_espacios = "Nombre";
echo wrapExercise('
<p>Texto con espacios: "'.$str_con_espacios.'"</p>
<p>Número de caracteres (CON espacio): '.strlen($str_con_espacios).'</p>
<p>Número de caracteres (SIN espacio): '.strlen($str_sin_espacios).'</p>
<p>Número de caracteres (usando trim()): '.strlen(trim($str_con_espacios)).'</p>
<div class="code-block">$str = " Nombre ";<br>echo strlen($str); // 7<br>echo strlen(trim($str)); // 6</div>
<pre>
Número de caracteres (CON espacio): 7
Número de caracteres (SIN espacio): 6
Número de caracteres (usando trim()): 6
</pre>
', 12, 'Función trim()');

// Ejercicio 13
$str = "La casa que es blanca está al fondo de la calle.";
$explode = explode(" ", $str);
ob_start(); // Inicia la captura de salida
echo '
<p>Texto original: '.$str.'</p>
<div class="code-block">$str = "La casa que es blanca...";<br>$explode = explode(" ", $str);<br>var_dump($explode);</div>
<pre>';
var_dump($explode);
echo '</pre>
<p>Mostrar la palabra "blanca" desde el array: '.$explode[4].'</p>
';
$output = ob_get_clean(); // Finaliza la captura
echo wrapExercise($output, 13, 'Función explode()');

// Ejercicio 14
$str1 = "John";
$str2 = "Flanigan";
echo wrapExercise('
<p>Concatenamos ambos str con ., resultado: '.$str1." ".$str2.'</p>
<p>Concatenamos ambos str con variables en string, resultado: '.$str1.' '.$str2.'</p>
<div class="code-block">$str1 = "John";<br>$str2 = "Flanigan";<br>echo $str1." ".$str2;<br>echo "$str1 $str2";</div>
<pre>
Concatenamos ambos str con ., resultado: John Flanigan
Concatenamos ambos str con variables en string, resultado: John Flanigan
</pre>
', 14, 'Concatenación de strings');

// Ejercicio 15
$str = "La casa que es blanca está al fondo de la calle.";
$extraccion = substr($str, 10);
echo wrapExercise('
<p>Texto original: '.$str.'</p>
<p>El substring es: '.$extraccion.'</p>
<div class="code-block">$str = "La casa que es blanca...";<br>echo substr($str, 10);</div>
<pre>El sub string es: que es blanca está al fondo de la calle.</pre>
', 15, 'Función substr()');

// Ejercicio 16
$array = array("Volvo", "Renault", "Citroen");
ob_start(); // Inicia la captura de salida
echo '
<div class="code-block">$array = array("Volvo", "Renault", "Citroen");<br>var_dump($array);<br>echo $array[0];</div>
<pre>';
var_dump($array);
echo '</pre>
<p>El primer coche del array es: '.$array[0].'</p>
';
$output = ob_get_clean(); // Finaliza la captura
echo wrapExercise($output, 16, 'Array de coches');

// Ejercicio 17
$array = array(71,39,214,12,589,471,36,15);
echo wrapExercise('
<div class="code-block">$array = array(71,39,214,12,589,471,36,15);<br>echo "Mayor: ".max($array);<br>echo "Menor: ".min($array);</div>
<p>El número MAYOR del array es: '.max($array).'</p>
<p>El número MENOR del array es: '.min($array).'</p>
<pre>
El número MAYOR del array es: 589
El número MENOR del array es: 12
</pre>
', 17, 'Mayor y menor en array');

// Ejercicio 18
// Definición de la clase para el ejercicio 18
class Persona {
   public $nombre;
   public $edad;

   public function __construct($nombre, $edad) {
      $this->nombre = $nombre;
      $this->edad = $edad;
   }

   public function getSaludo() {
      return "Hola ".$this->nombre;
   }
}
$persona1 = new Persona("Pepe", 15);

ob_start(); // Inicia la captura de salida
echo '
<div class="code-block">class Persona {<br>   public $nombre;<br>   public $edad;<br><br>   public function __construct($nombre, $edad) {<br>      $this->nombre = $nombre;<br>      $this->edad = $edad;<br>   }<br><br>   public function getSaludo() {<br>      return "Hola ".$this->nombre;<br>   }<br>}<br>$persona1 = new Persona("Pepe", 15);<br>echo $persona1->getSaludo();</div>
<p>Mostramos el saludo de la clase: '.$persona1->getSaludo().'</p>
<pre>Mostramos el saludo de la clase: Hola Pepe</pre>
';
$output = ob_get_clean(); // Finaliza la captura
echo wrapExercise($output, 18, 'Clase Persona');

// Ejercicio 19
// Definición de la clase para el ejercicio 19
class Persona19 {
   public $nombre;
   public $edad;
   private $dni; // Propiedad privada

   public function __construct($nombre, $edad, $dni) {
      $this->nombre = $nombre;
      $this->edad = $edad;
      $this->dni = $dni;
   }

   public function getSaludo() {
      return "Hola ".$this->nombre;
   }

   // Getter para DNI
   public function getDni() {
      return $this->dni;
   }

   // Setter para DNI
   public function setDni($dni) {
      $this->dni = $dni;
   }
}

ob_start(); // Inicia la captura de salida
$persona1_ej19 = new Persona19("Pepe", 15, "00000000A"); // Instanciamos la clase

echo '
<div class="code-block">class Persona19 {<br>   public $nombre;<br>   public $edad;<br>   private $dni;<br><br>   public function __construct($nombre, $edad, $dni) {<br>      $this->nombre = $nombre;<br>      $this->edad = $edad;<br>      $this->dni = $dni;<br>   }<br><br>   public function getSaludo() {<br>      return "Hola ".$this->nombre;<br>   }<br><br>   public function getDni() {<br>      return $this->dni;<br>   }<br><br>   public function setDni($dni) {<br>      $this->dni = $dni;<br>   }<br>}</div>
<p>El dni inicial es: '.$persona1_ej19->getDni().'</p>
<p>Modificamos el dni:</p>
<div class="code-block">$persona1_ej19->setDni("00000000B");<br>echo $persona1_ej19->getDni();</div>
';
$persona1_ej19->setDni("00000000B"); // Modificamos el DNI
echo '<p>El NUEVO dni es: '.$persona1_ej19->getDni().'</p>
<pre>
El dni inicial es: 00000000A
El NUEVO dni es: 00000000B
</pre>
';
$output = ob_get_clean(); // Finaliza la captura
echo wrapExercise($output, 19, 'Propiedad privada');


// Ejercicio 20
$var_int = 8;
$var_float = 10.25;
$var_bool = true;
$var_str = "Esto es un string";
$var_null = null;

$int_array = (array) $var_int;
$float_array = (array) $var_float;
$bool_array = (array) $var_bool;
$str_array = (array) $var_str;
$null_array = (array) $var_null;

ob_start(); // Inicia la captura de salida
echo '
<div class="code-block">$var_int = 8;<br>$int_array = (array)$var_int;<br>var_dump($int_array);<br>var_dump((object)$int_array);</div>
<p>Impresión cast int to array:</p>
<pre>';
var_dump($int_array);
echo '</pre>
<p>Impresión cast int to array to object:</p>
<pre>';
var_dump((object) $int_array);
echo '</pre>
';
$output = ob_get_clean(); // Finaliza la captura
echo wrapExercise($output, 20, 'Conversiones a array y objeto');

// Ejercicio 21
function getDomain($email) {
   $pos = strpos($email, "@") + 1;
   $dominio = substr($email, $pos);
   return $dominio;
}

echo wrapExercise('
<div class="code-block">function getDomain($email) {<br>   $pos = strpos($email, "@") + 1;<br>   return substr($email, $pos);<br>}<br>echo getDomain("info@dominio.es");</div>
<p>Ej1. El dominio es: '.getDomain("info@dominio.es").'</p>
<p>Ej2. El dominio es: '.getDomain("administracion@burgerking.es").'</p>
<pre>
Ej1. El dominio es: dominio.es
Ej2. El dominio es: burgerking.es
</pre>
', 21, 'Extraer dominio de email');

// Cerrar el contenedor principal y HTML
echo '</div>
</body>
</html>';

?>
