<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Apuntes de PHP Dinámicos - Parte 2</title>
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
        <h2>Apuntes PHP (II)</h2>
        <ul>
            <li><a href="#operadores">Operadores</a></li>
            <li><a href="#estructuras_bucle">Estructuras de Bucle</a></li>
            <li><a href="#arrays">Arrays</a></li>
            <li><a href="#funciones_personalizadas">Funciones Personalizadas</a></li>
        </ul>
    </aside>

    <main id="content">
        <h1>Conceptos Avanzados de PHP</h1>

        <?php
        // Función auxiliar para aplicar resaltado de sintaxis básico
        function highlight_php_code($code) {
            $code = htmlspecialchars($code); // Escapa caracteres HTML para evitar XSS
            $code = preg_replace('/&lt;\?php/', '<span class="php-tag">&lt;?php</span>', $code);
            $code = preg_replace('/\?&gt;/', '<span class="php-tag">?&gt;</span>', $code);
            $code = preg_replace('/\b(function|class|echo|var_dump|include|if|else|elseif|while|for|foreach|return|new|public|private|static|global|const|define|true|false|null|array|__construct|__CLASS__|__DIR__|__FILE__|__FUNCTION__|__LINE__|__METHOD__|__NAMESPACE__|__TRAIT__|Classname::class|break|continue|default|switch|case)\b/', '<span class="php-keyword">$1</span>', $code);
            $code = preg_replace('/(\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/', '<span class="php-variable">$1</span>', $code);
            $code = preg_replace('/(".*?")|(\'.*?\')/', '<span class="php-string">$0</span>', $code);
            $code = preg_replace('/\b(\d+\.?\d*)\b/', '<span class="php-number">$0</span>', $code);
            $code = preg_replace('/\/\/(.*?)(\r?\n|$)/', '<span class="php-comment">//$1</span>$2', $code); // Comentarios de una línea
            $code = preg_replace('/(\/\*.*?\*\/)/s', '<span class="php-comment">$1</span>', $code); // Comentarios de varias líneas
            $code = preg_replace('/([+\-*\/=<>!&|.%])/', '<span class="php-operator">$1</span>', $code); // Operadores
            // Funciones built-in adicionales (añadidas algunas para arrays y funciones)
            $code = preg_replace('/\b(strlen|str_word_count|strpos|strtoupper|strtolower|str_replace|strrev|trim|explode|print_r|substr|is_int|is_float|is_numeric|acos|pi|min|max|abs|sqrt|round|rand|count|sort|rsort|asort|ksort|array_push|array_pop|implode|array_values|array_keys)\b/', '<span class="php-builtin">$1</span>', $code);

            return '<pre><code>' . $code . '</code></pre>';
        }

        ?>

        <div id="operadores">
            <h2>Operadores</h2>
            <p>Los operadores se usan para realizar operaciones con variables y valores. PHP soporta una amplia gama de operadores.</p>

            <h3>Operadores Aritméticos</h3>
            <p>Se usan para realizar operaciones matemáticas comunes.</p>
            <ul>
                <li>`+` Suma</li>
                <li>`-` Resta</li>
                <li>`*` Multiplicación</li>
                <li>`/` División</li>
                <li>`%` Módulo (resto de la división)</li>
                <li>`**` Exponenciación (PHP 5.6+)</li>
            </ul>
            <?php echo highlight_php_code('
$a = 10;
$b = 3;
echo "Suma: " . ($a + $b) . "<br>";     // 13
echo "Resta: " . ($a - $b) . "<br>";    // 7
echo "Multiplicación: " . ($a * $b) . "<br>"; // 30
echo "División: " . ($a / $b) . "<br>";    // 3.333...
echo "Módulo: " . ($a % $b) . "<br>";     // 1
echo "Exponenciación: " . ($a ** $b) . "<br>"; // 1000
            '); ?>

            <h3>Operadores de Asignación</h3>
            <p>Se usan para escribir valores en variables.</p>
            <ul>
                <li>`=` Asignación simple</li>
                <li>`+=` Suma y asigna</li>
                <li>`-=` Resta y asigna</li>
                <li>`*=` Multiplica y asigna</li>
                <li>`/=` Divide y asigna</li>
                <li>`.=` Concatena y asigna (para strings)</li>
                <li>`%=` Módulo y asigna</li>
            </ul>
            <?php echo highlight_php_code('
$x = 10;
echo "Valor inicial de x: " . $x . "<br>";
$x += 5; // $x = $x + 5;
echo "x después de += 5: " . $x . "<br>"; // 15
$x .= " mundo"; // $x = $x . " mundo";
echo "x después de .= \" mundo\": " . $x . "<br>"; // "15 mundo"
            '); ?>

            <h3>Operadores de Comparación</h3>
            <p>Se usan para comparar dos valores. Devuelven `true` o `false`.</p>
            <ul>
                <li>`==` Igual (valor)</li>
                <li>`===` Idéntico (valor y tipo)</li>
                <li>`!=` o `<>` Diferente (valor)</li>
                <li>`!==` No idéntico (valor o tipo)</li>
                <li>`>` Mayor que</li>
                <li>`<` Menor que</li>
                <li>`>=` Mayor o igual que</li>
                <li>`<=` Menor o igual que</li>
                <li>`<=>` Spaceship (Desde PHP 7, devuelve -1, 0 o 1)</li>
            </ul>
            <?php echo highlight_php_code('
$a = 10;
$b = "10";
var_dump($a == $b);  // true (valores iguales)
var_dump($a === $b); // false (tipos diferentes)
var_dump($a !== $b); // true (tipos diferentes)
var_dump($a > 5);    // true
var_dump($a <=> 10); // 0 (si son iguales)
var_dump($a <=> 5);  // 1 (si $a es mayor)
var_dump($a <=> 15); // -1 (si $a es menor)
            '); ?>

            <h3>Operadores de Incremento/Decremento</h3>
            <p>Se usan para incrementar o decrementar el valor de una variable.</p>
            <ul>
                <li>`++$x` Pre-incremento (incrementa, luego devuelve)</li>
                <li>`$x++` Post-incremento (devuelve, luego incrementa)</li>
                <li>`--$x` Pre-decremento (decrementa, luego devuelve)</li>
                <li>`$x--` Post-decremento (devuelve, luego decrementa)</li>
            </ul>
            <?php echo highlight_php_code('
$i = 5;
echo "Pre-incremento: " . (++$i) . "<br>"; // 6, luego $i es 6
echo "Post-incremento: " . ($i++) . "<br>"; // 6, luego $i es 7
echo "Valor final de i: " . $i . "<br>";    // 7
            '); ?>

            <h3>Operadores Lógicos</h3>
            <p>Se usan para combinar sentencias condicionales.</p>
            <ul>
                <li>`and` o `&&` AND (ambas condiciones deben ser `true`)</li>
                <li>`or` o `||` OR (al menos una condición debe ser `true`)</li>
                <li>`xor` XOR (una de las dos condiciones debe ser `true`, pero no ambas)</li>
                <li>`!` NOT (invierte el resultado)</li>
            </ul>
            <?php echo highlight_php_code('
$edad = 20;
$tiene_licencia = true;
if ($edad >= 18 && $tiene_licencia) {
    echo "Puede conducir.<br>";
}

$es_dia = true;
$es_noche = false;
if ($es_dia xor $es_noche) {
    echo "Es o día o noche, pero no ambos.<br>";
}
            '); ?>

            <h3>Operadores de Cadena</h3>
            <p>Para manipular strings.</p>
            <ul>
                <li>`.` Concatenación</li>
                <li>`.=` Concatenación y asignación</li>
            </ul>
            <?php echo highlight_php_code('
$saludo = "Hola";
$nombre = "Mundo";
echo $saludo . " " . $nombre . "!"; // "Hola Mundo!"
            '); ?>
        </div>

        <div id="estructuras_bucle">
            <h2>Estructuras de Bucle</h2>
            <p>Las estructuras de bucle se usan para ejecutar el mismo bloque de código repetidamente, siempre que se cumpla una condición.</p>

            <h3>While Loop</h3>
            <p>Ejecuta un bloque de código siempre que la condición especificada sea verdadera.</p>
            <?php echo highlight_php_code('
$i = 1;
while ($i < 6) {
    echo "El número es: " . $i . "<br>";
    $i++;
}
            '); ?>

            <h3>Do...While Loop</h3>
            <p>Este bucle siempre ejecutará el bloque de código al menos una vez, y luego repetirá el bucle siempre que la condición especificada sea verdadera.</p>
            <?php echo highlight_php_code('
$i = 1;
do {
    echo "El número es: " . $i . "<br>";
    $i++;
} while ($i < 6);
            '); ?>

            <h3>For Loop</h3>
            <p>Se usa cuando sabes cuántas veces quieres ejecutar un bloque de código.</p>
            <ul>
                <li>`init`: Inicializa el contador del bucle.</li>
                <li>`condition`: La condición que se evalúa en cada iteración.</li>
                <li>`increment`: Incrementa el contador del bucle.</li>
            </ul>
            <?php echo highlight_php_code('
for ($i = 0; $i <= 10; $i++) {
    echo "El número es: " . $i . "<br>";
}
            '); ?>

            <h3>Foreach Loop</h3>
            <p>Se usa para iterar sobre elementos de un array. Es la forma más fácil de recorrer arrays.</p>
            <?php echo highlight_php_code('
$colores = array("rojo", "verde", "azul", "amarillo");
foreach ($colores as $valor) {
    echo $valor . "<br>";
}

// Con clave y valor para arrays asociativos
$edad = array("Pedro" => "35", "Ana" => "37", "Juan" => "43");
foreach ($edad as $nombre => $valor) {
    echo $nombre . " tiene " . $valor . " años.<br>";
}
            '); ?>

            <h3>Break y Continue</h3>
            <ul>
                <li>`break`: Se usa para salir de un bucle inmediatamente.</li>
                <li>`continue`: Se usa para saltar la iteración actual de un bucle y continuar con la siguiente.</li>
            </ul>
            <?php echo highlight_php_code('
for ($i = 0; $i < 10; $i++) {
    if ($i == 4) {
        break; // Sale del bucle cuando i es 4
    }
    echo "Break: " . $i . "<br>";
}

for ($i = 0; $i < 10; $i++) {
    if ($i == 4) {
        continue; // Salta la iteración cuando i es 4
    }
    echo "Continue: " . $i . "<br>";
}
            '); ?>
        </div>

        <div id="arrays">
            <h2>Arrays</h2>
            <p>Un array almacena múltiples valores en una sola variable. Son muy versátiles y fundamentales en PHP.</p>

            <h3>Arrays Indexados (Numéricos)</h3>
            <p>Los arrays con un índice numérico.</p>
            <?php echo highlight_php_code('
$coches = array("Volvo", "BMW", "Toyota");
echo "Mi coche favorito es: " . $coches[0] . "<br>"; // Acceder por índice

// Recorrer un array indexado
$longitud_array = count($coches); // count() devuelve el número de elementos
for ($x = 0; $x < $longitud_array; $x++) {
    echo $coches[$x] . "<br>";
}
            '); ?>

            <h3>Arrays Asociativos</h3>
            <p>Los arrays con claves nombradas a las que se asignan valores.</p>
            <?php echo highlight_php_code('
$edad = array("Pedro" => "35", "Ana" => "37", "Juan" => "43");
echo "Ana tiene " . $edad[\'Ana\'] . " años.<br>"; // Acceder por clave
echo "Juan tiene " . $edad["Juan"] . " años.<br>";

// Añadir un nuevo elemento
$edad["Maria"] = "29";
var_dump($edad);
            '); ?>

            <h3>Arrays Multidimensionales</h3>
            <p>Arrays que contienen uno o más arrays.</p>
            <?php echo highlight_php_code('
$coches_multi = array (
    array("Volvo",22,18),
    array("BMW",15,13),
    array("Saab",5,2),
    array("Land Rover",17,15)
);

echo $coches_multi[0][0].": En stock: ".$coches_multi[0][1].", vendidos: ".$coches_multi[0][2].".<br>";
echo $coches_multi[1][0].": En stock: ".$coches_multi[1][1].", vendidos: ".$coches_multi[1][2].".<br>";

// Recorrer un array multidimensional
for ($row = 0; $row < 4; $row++) {
    echo "<p><b>Fila número $row</b></p>";
    echo "<ul>";
    for ($col = 0; $col < 3; $col++) {
        echo "<li>".$coches_multi[$row][$col]."</li>";
    }
    echo "</ul>";
}
            '); ?>

            <h3>Funciones de Array Útiles</h3>
            <ul>
                <li>`count()`: Devuelve el número de elementos en un array.</li>
                <li>`sort()`: Ordena un array indexado en orden ascendente.</li>
                <li>`rsort()`: Ordena un array indexado en orden descendente.</li>
                <li>`asort()`: Ordena un array asociativo por valor en orden ascendente.</li>
                <li>`ksort()`: Ordena un array asociativo por clave en orden ascendente.</li>
                <li>`array_push()`: Añade uno o más elementos al final de un array.</li>
                <li>`array_pop()`: Extrae el último elemento de un array.</li>
                <li>`implode()`: Une elementos de un array en un string.</li>
                <li>`explode()`: (Ya vista) Divide un string en un array.</li>
            </ul>
            <?php echo highlight_php_code('
$numeros = array(4, 2, 8, 1);
sort($numeros); // Ordena el array
print_r($numeros); // Output: Array ( [0] => 1 [1] => 2 [2] => 4 [3] => 8 )
echo "<br>";

$cadena_unida = implode("-", $numeros); // Une los elementos con un guion
echo $cadena_unida; // Output: 1-2-4-8
            '); ?>
        </div>

        <div id="funciones_personalizadas">
            <h2>Funciones Personalizadas</h2>
            <p>Además de las funciones nativas, puedes crear tus propias funciones para encapsular bloques de código reutilizables.</p>
            <p>Una función es un bloque de sentencias que puede ser usado repetidamente en un programa.</p>
            <p>Las funciones no se ejecutan automáticamente cuando se carga la página. Se ejecutarán con una llamada a la función.</p>

            <h3>Declaración de una Función</h3>
            <p>La declaración de una función comienza con la palabra clave `function` seguida del nombre de la función y paréntesis `()`. El código de la función se coloca dentro de llaves `{}`.</p>
            <?php echo highlight_php_code('
function miFuncionSimple() {
    echo "¡Hola desde mi primera función!<br>";
}

// Llamar a la función
miFuncionSimple();
            '); ?>

            <h3>Funciones con Parámetros</h3>
            <p>Los parámetros son variables que se pasan a la función. Permiten que la función acepte entradas.</p>
            <?php echo highlight_php_code('
function saludar($nombre) {
    echo "¡Hola, " . $nombre . "!<br>";
}

saludar("Juan"); // Llamada con un argumento
saludar("María");
            '); ?>

            <h3>Funciones con Valores por Defecto en Parámetros</h3>
            <p>Puedes especificar un valor por defecto para un parámetro. Si no se pasa un argumento para ese parámetro, se usará el valor por defecto.</p>
            <?php echo highlight_php_code('
function setAltura($minaltura = 50) {
    echo "La altura es : $minaltura <br>";
}

setAltura(350); // Usa 350
setAltura();    // Usa el valor por defecto (50)
setAltura(135);
            '); ?>

            <h3>Funciones que Devuelven Valores (Return)</h3>
            <p>Una función puede devolver un valor usando la sentencia `return`.</p>
            <?php echo highlight_php_code('
function sumar($num1, $num2) {
    $resultado = $num1 + $num2;
    return $resultado;
}

$total = sumar(5, 3);
echo "La suma es: " . $total . "<br>"; // 8

echo "La suma de 10 y 20 es: " . sumar(10, 20) . "<br>"; // 30
            '); ?>

            <h3>Declaración de Tipos Escalares (Desde PHP 7)</h3>
            <p>Puedes forzar tipos de datos para los argumentos de la función y para el valor de retorno.</p>
            <?php echo highlight_php_code('
// Declaración de tipo para el parámetro (int)
function addNumbers(int $a, int $b) {
    return $a + $b;
}
echo addNumbers(5, 10) . "<br>"; // 15
// echo addNumbers(5, "10 euros"); // Esto daría un TypeError en modo estricto

// Declaración de tipo para el valor de retorno (float)
function multiplicar(float $num1, float $num2): float {
    return $num1 * $num2;
}
echo multiplicar(2.5, 4) . "<br>"; // 10
            '); ?>

            <h3>Ejercicio 3:</h3>
            <p>1) Crea una función llamada `esPar` que reciba un número entero.</p>
            <p>2) La función debe devolver `true` si el número es par y `false` si es impar.</p>
            <p>3) Llama a la función con varios números e imprime el resultado.</p>
            <?php echo highlight_php_code('
function esPar(int $numero): bool {
    if ($numero % 2 == 0) {
        return true;
    } else {
        return false;
    }
}

echo "El número 4 es par: " . (esPar(4) ? "Sí" : "No") . "<br>";
echo "El número 7 es par: " . (esPar(7) ? "Sí" : "No") . "<br>";
echo "El número 0 es par: " . (esPar(0) ? "Sí" : "No") . "<br>";
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