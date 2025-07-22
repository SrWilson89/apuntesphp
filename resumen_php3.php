<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Apuntes de PHP Dinámicos</title>
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
        <h2>Apuntes PHP</h2>
        <ul>
            <li><a href="#introduccion">Introducción</a></li>
            <li><a href="#variables">Variables PHP</a></li>
            <li><a href="#ambito_variables">Ámbito de Variables</a></li>
            <li><a href="#impresion_pantalla">Impresión por Pantalla</a></li>
            <li><a href="#objetos">Objetos (Clases)</a></li>
            <li><a href="#funciones_nativas">Funciones Nativas PHP</a></li>
            <li><a href="#numeros">Números</a></li>
            <li><a href="#constantes">Constantes</a></li>
            <li><a href="#estructuras_condicionales">Estructuras Condicionales</a></li>
            </ul>
    </aside>

    <main id="content">
        <h1>Conceptos Básicos de PHP</h1>

        <?php
        // Función auxiliar para aplicar resaltado de sintaxis básico
        function highlight_php_code($code) {
            $code = htmlspecialchars($code); // Escapa caracteres HTML para evitar XSS
            $code = preg_replace('/&lt;\?php/', '<span class="php-tag">&lt;?php</span>', $code);
            $code = preg_replace('/\?&gt;/', '<span class="php-tag">?&gt;</span>', $code);
            $code = preg_replace('/\b(function|class|echo|var_dump|include|if|else|elseif|while|for|foreach|return|new|public|private|static|global|const|define|true|false|null|array|__construct|__CLASS__|__DIR__|__FILE__|__FUNCTION__|__LINE__|__METHOD__|__NAMESPACE__|__TRAIT__|Classname::class)\b/', '<span class="php-keyword">$1</span>', $code);
            $code = preg_replace('/(\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/', '<span class="php-variable">$1</span>', $code);
            $code = preg_replace('/(".*?")|(\'.*?\')/', '<span class="php-string">$0</span>', $code);
            $code = preg_replace('/\b(\d+\.?\d*)\b/', '<span class="php-number">$0</span>', $code);
            $code = preg_replace('/\/\/(.*?)(\r?\n|$)/', '<span class="php-comment">//$1</span>$2', $code); // Comentarios de una línea
            $code = preg_replace('/(\/\*.*?\*\/)/s', '<span class="php-comment">$1</span>', $code); // Comentarios de varias líneas
            $code = preg_replace('/([+\-*\/=<>!&|.%])/', '<span class="php-operator">$1</span>', $code); // Operadores
            // Funciones built-in adicionales
            $code = preg_replace('/\b(strlen|str_word_count|strpos|strtoupper|strtolower|str_replace|strrev|trim|explode|print_r|substr|is_int|is_float|is_numeric|acos|pi|min|max|abs|sqrt|round|rand)\b/', '<span class="php-builtin">$1</span>', $code);

            return '<pre><code>' . $code . '</code></pre>';
        }

        ?>

        <div id="introduccion">
            <h2>Introducción</h2>
            <p>Los archivos php deben tener extensión .php</p>
            <p>La primera línea del archivo debe comenzar por: &lt;?php</p>
            <p>PHP es un lenguaje que se ejecuta en máquina servidor</p>
            <p>PHP es un lenguaje interpretado (no compilado)</p>
            <p>PHP necesita un servidor como XAMPP para ejecutar (interpretar) el archivo</p>
            <p>Si usamos XAMPP, el archivo debe estar en la carpeta "htdocs"</p>
        </div>

        <div id="variables">
            <h2>Variables PHP</h2>
            <h3>Nombre de las variables</h3>
            <p>Las variables son datos que se almacenan en un tipo de dato específico</p>
            <p>Se almacenan en memoria (no persistente)</p>
            <p>Es decir, cuando se apaga el servidor o se cierra el script, desaparece de memoria</p>
            <p>Las variables se nombran con "$" y el nombre de la variable, ejemplo: $mi_variable</p>
            <p>El nombre de las variables son case sensitive (distinguen mayúsculas de minúsculas)</p>
            <p>No es lo mismo $mi_variable que $MI_VARIABLE</p>

            <h3>Tipos de variables</h3>
            <ul>
                <li>String -> Cadenas de texto (se entrecomillan con comillas dobles)</li>
                <li>Integer -> Números enteros (positivos o negativos)</li>
                <li>Float -> Números decimales (positivos o negativos)</li>
                <li>Arrays -> Son matrices de NxM, por ejemplo: de 1x10 (1 columna y 10 filas)</li>
                <li>Objetos -> Son tipo objeto</li>
                <li>Boolean -> Tipo booleano, sólo puede valor true (1) o false (0)</li>
                <li>NULL -> Valor especial de una variable, valor nulo (distinto de vacío)</li>
                <li>Resource -> Son recursos del sistema (buffer de datos, otra clase php, etc...)</li>
            </ul>
            <p>PHP no necesita declarar el tipo de dato al que pertenece una variable</p>
            <p>Es decir, interpreta según el valor, qué tipo de variable es</p>
            <p>Por ejemplo, si asigno un número entero a la variable, php interpreta que es de tipo integer</p>
            <p>Otro ejemplo: Si asigno una cadena de texto, interpreta que es un string</p>
            <p>Para obtener el tipo de variable se usa "var_dump($nombre);"</p>
            <p>Nos indicará con qué tipo ha declarado PHP a la variable</p>
            <p>Ejemplo: Declaramos una cadena de texto y consultamos cómo lo ha declarado PHP</p>
            <?php echo highlight_php_code('$mi_cadena_de_texto = "Esta es mi primera frase";'); ?>
            <?php echo highlight_php_code('var_dump($mi_cadena_de_texto);'); ?>
            <p>Resultado: string(24) "Esta es mi primera frase"</p>

            <h3>Ejemplos de definición de variables</h3>
            <?php echo highlight_php_code('$mi_primer_integer = 5; //Ejemplo: Declaración de integer'); ?>
            <?php echo highlight_php_code('$mi_primer_float = 10.52; //Ejemplo: Declaración de float'); ?>
            <?php echo highlight_php_code('$mi_primer_boolean = true;'); ?>
            <?php echo highlight_php_code('$mi_primer_array = array("Blanco", "Rojo", "Azul", "Verde");'); ?>

            <h3>Ejercicio 1:</h3>
            <p>1) Crea una variable string, integer, float, boolean y array</p>
            <p>2) Imprímelas en pantalla para que aparezca el tipo de variable y su valor</p>
            <?php echo highlight_php_code('$str = "Mi primer string";'); ?>
            <?php echo highlight_php_code('var_dump($str);'); ?>
            <?php echo highlight_php_code('$int = 8;'); ?>
            <?php echo highlight_php_code('var_dump($int);'); ?>
            <?php echo highlight_php_code('$float = 84.36;'); ?>
            <?php echo highlight_php_code('var_dump($float);'); ?>
            <?php echo highlight_php_code('$bool = false;'); ?>
            <?php echo highlight_php_code('var_dump($bool);'); ?>
            <?php echo highlight_php_code('$array = array("Blanco", "Negro");'); ?>
            <?php echo highlight_php_code('var_dump($array);'); ?>
        </div>

        <div id="ambito_variables">
            <h2>Ámbito de las variables</h2>
            <p>Las variables tienen distintos ámbitos de actuación, se pueden limitar a una zona de ejecución concreta.</p>
            <h3>Tipos:</h3>
            <ul>
                <li>**local** -> La que se ejecuta en una función/método, o en un archivo PHP concreto. Sólo es accesible desde ese trozo de código.</li>
                <li>**global** -> Accesible desde todo el sistema.</li>
                <li>**static** -> Son variables locales que funcionan como globales.</li>
            </ul>

            <h3>Ejemplo variable global</h3>
            <?php echo highlight_php_code('$x = 5; // Definir una variable global'); ?>
            <?php echo highlight_php_code('
function myTest1() {
  // Dentro de la función NO se puede usar la variable global directamente
  // echo "<p>Variable x inside function is: $x</p>"; // Esto daría un error Undefined variable
}
myTest1(); //Llamamos a la función para que ejecute
//Como la variable es global, también podemos llamarla desde fuera de la función
echo "<p>Variable x outside function is: $x</p>";
            '); ?>
            <p>Aquí la variable `$x` definida fuera de la función es global y accesible fuera de ella, pero no directamente dentro de la función sin usar `global`.</p>

            <h3>Ejemplo de variable local</h3>
            <?php echo highlight_php_code('
function myTest2() {
  $x = 5; // Definimos una variable local
  //Imprimimos la variable
  echo "<p>Variable x inside function is: $x</p>";
}
myTest2(); //Llamamos a la función

// Llamamos a la variable desde fuera de la función, da error, ya que no es accesible
// echo "<p>Variable x outside function is: $x</p>"; // Esto daría un error Undefined variable
            '); ?>
            <p>La variable `$x` definida dentro de `myTest2()` es local y solo existe dentro de esa función.</p>

            <h3>Ejemplo de variable global definida desde una función (usando `global`)</h3>
            <?php echo highlight_php_code('
$x = 5; //Definimos una variable global 1
$y = 10; //Definimos una variable global 2

function myTest3() {
  global $x, $y; //Indicamos que las variables globales las permita usar dentro de la función
  $y = $x + $y; //usamos las variables
}
myTest3(); //Llamamos a la función
echo $y; // Imprimimos el resultado
            '); ?>
            <p>Al usar la palabra clave `global`, podemos acceder y modificar variables definidas en el ámbito global dentro de una función.</p>

            <h3>Ejemplo de variable estática</h3>
            <?php echo highlight_php_code('
function myTest4() {
  static $xz = 0; //Definimos una variable local y estática
  echo $xz; //Imprimo
  $xz++; //La sumo 1
}
//Ejecuto la función.
/** Al ser la variable local (sólo se puede usar dentro de la función)
 * interna de la función estática
 * no se destruye en memoria
 * por tanto, cada vez que se llama a la función, mantiene el valor anterior
 * Permite reutilizar el valor de la variable, dentro de la función.
 */
myTest4(); // Imprimirá 0
myTest4(); // Imprimirá 1
myTest4(); // Imprimirá 2
            '); ?>
            <p>Una variable `static` dentro de una función retiene su valor entre llamadas a la función.</p>
        </div>

        <div id="impresion_pantalla">
            <h2>Impresión por pantalla</h2>
            <p>Podemos usar "echo" para imprimir información en texto plano por pantalla.</p>
            <h3>Tipos (es lo mismo):</h3>
            <?php echo highlight_php_code('echo "Hello";'); ?>
            <?php echo highlight_php_code('echo("Hello");'); ?>

            <h3>Impresión por pantalla de variables</h3>
            <?php echo highlight_php_code('
$txt1 = "Learn PHP"; //Definimos una variable
$txt2 = "W3Schools.com"; //Definimos otra variable

//Se pueda imprimir la variable directamente poniendo el nombre de la variable
//en la cadena de texto
//IMPORTANTE! Siempre que esté con entrecomillado doble
echo "<h2>$txt1</h2>";
echo "<p>Study PHP at $txt2</p>";
            '); ?>

            <h3>Impresión de variables con concatenación</h3>
            <p>Si la cadena de texto está entrecomillada con comillas simples, debemos concatenar las cadenas de texto y las variables con un ".". </p>
            <?php echo highlight_php_code('
$txt1 = "Learn PHP"; //Definimos una variable
$txt2 = "W3Schools.com"; //Definimos otra variable

echo \'<h2>\' . $txt1 . \'</h2>\';
echo \'<p>Study PHP at \' . $txt2 . \'</p>\';
            '); ?>

            <h3>Impresión con comando `print`</h3>
            <p>También se puede imprimir por pantalla con "print". Ambas formas son iguales.</p>
            <?php echo highlight_php_code('print "Hello";'); ?>
            <?php echo highlight_php_code('print("Hello");'); ?>
        </div>

        <div id="objetos">
            <h2>Objetos</h2>
            <p>Clases y objetos son dos conceptos fundamentales en la programación orientada a objetos.</p>
            <ul>
                <li>La **clase** es una plantilla para el objeto.</li>
                <li>Y el **objeto**, es la instancia (creación) de la clase.</li>
            </ul>
            <p>Ejemplo: Clase: Coche (color, modelo, etc..), Objeto: Coche (Amarillo, Volvo, etc...)</p>

            <h3>Definiendo una Clase</h3>
            <p>Dentro de la clase se define:</p>
            <ol>
                <li>Atributos/Propiedades de la clase</li>
                <li>Método "constructor"</li>
                <li>Funciones que contendrá la clase</li>
            </ol>
            <?php echo highlight_php_code('
class Car {
    /** Dentro de la clase, definimos los atributos/propiedades que contendrá esta
     * En nuestro ejemplo: color y modelo
     * Podemos añadir cualquier tipo de dato, y tantos atributos de clase como queramos
     * Los atributos pueden tener dos ámbitos:
     * 1) Público (public): Es accesible desde fuera de la clase.
     * 2) Privado (private): Sólo es accesible desde dentro de la clase.
     */
  public $color;
  public $model;

  /** Definimos una función "especial" que se llama el constructor
   * Se llama: __construct()
   * Sus parámetros funcionan como en el resto de funciones
   * En este ejemplo los parámetros son obligatorios (también pueden ser opcionales)
   */
  public function __construct($color, $model) {
    /** Dentro del constructor
     * Asignamos las variables (parámetros de entrada de la función)
     * A los atributos/propiedades de la clase
     * $this->color => Se refiere al atributo de la clase
     * $color => Se refiere al parámetro de la función
     */
    $this->color = $color;
    $this->model = $model;
  }

  /** Las clases pueden tener funciones */
  /** El objetivo de esta función es imprimir una frase indicando el color y el modelo*/
  public function message() {
    return "My car is a " . $this->color . " " . $this->model . "!";
  }
}
            '); ?>

            <h3>Instanciando un Objeto</h3>
            <?php echo highlight_php_code('
/** Instanciamos un objeto de clase "Car"
 * $myCar es la variable (tipo objeto) donde se guardará el objeto
 * new Car(); => Es la forma para instanciar el objeto, o crear el objeto de la clase "Car"
 * Como el constructor de la clase indica que necesita dos parámetros obligatorios
 * le debemos indicar: color, modelo
*/
$myCar = new Car("red", "Volvo");
var_dump($myCar); //Imprimir el objeto
            '); ?>

            <h3>Ejercicio 2:</h3>
            <p>1) Crea una clase llamada "ordenador"</p>
            <p>2) El ordenador puede tener: cpu, ram, hdd y so</p>
            <p>3) Crea una función que imprima el resumen de las características del ordenador</p>
            <p>4) Instancia un ordenador e imprime sus características</p>

            <?php echo highlight_php_code('
//Definimos la clase
class ordenador {
    //Definimos los atributos de la clase
    public $cpu;
    public $ram;
    public $hdd;
    public $so;
    //Definimos el constructor
    public function __construct($cpu, $ram, $hdd, $so) {
        //Asigno los valores de los parámetros a los atributos de la clase
        $this->cpu = $cpu;
        $this->ram = $ram;
        $this->hdd = $hdd;
        $this->so = $so;
    }
    //Definimos la función "mensaje" con return
    public function msg1() {
        return "Las características del ordenador son:<br>".
            "CPU: ".$this->cpu."<br>".
            "RAM: ".$this->ram."<br>".
            "HDD: ".$this->hdd."<br>".
            "Sistema Operativo: ".$this->so;
    }

    //Definimos la función "mensaje" SIN return (que imprima directamente)
    public function msg2() {
        echo "Las características del ordenador son:<br>".
            "CPU: ".$this->cpu."<br>".
            "RAM: ".$this->ram."<br>".
            "HDD: ".$this->hdd."<br>".
            "Sistema Operativo: ".$this->so;
    }
}
//Creo una instancia de la clase (creo un objeto de la clase ordenador)
$myOrdenador = new ordenador("Intel", "20 GB", "1 TB", "Windows");
//Imprimos el mensaje1 de la clase (devuelve una cadena de texto)
$mensaje = $myOrdenador->msg1(); //Guardar cadena de texto en variable $mensaje
echo $mensaje; //Imprimo la cadena de texto
//Imprimo el mensaje2 de la clase (no devuelve nada, imprime directamente)
echo "<br>";
$myOrdenador->msg2();
            '); ?>
        </div>

        <div id="funciones_nativas">
            <h2>Funciones Nativas de PHP</h2>
            <p>PHP tiene funciones nativas (predefinidas) que hacen "cosas". Cada una tiene su nombre y no se puede cambiar (se llaman como indique la documentación).</p>

            <h3>Funciones de PHP para strings</h3>
            <?php echo highlight_php_code('echo strlen("Hello world!"); // Indica el número de caracteres de la cadena.'); ?>
            <?php echo highlight_php_code('echo str_word_count("Hello world!"); // Indica el número de palabras de la cadena.'); ?>
            <?php echo highlight_php_code('
//Indica la primera posición de la palabra a buscar
//En PHP, los índices comienzan en cero
//1 param: Cadena de texto donde quiero buscar
//2 param: Es la palabra que quiero encontrar
echo strpos("Hello world!", "world");
            '); ?>
            <?php echo highlight_php_code('echo strtoupper("Hello World!"); // Cambia la cadena de texto a mayúsculas'); ?>
            <?php echo highlight_php_code('echo strtolower("HELLO WORLD!"); // Cambia la cadena de texto a minúsculas'); ?>
            <?php echo highlight_php_code('
//Reemplaza cadenas de texto
//1 param: Palabra a reemplazar
//2 param: Palabra de reemplazo
//3 param: Cadena de texto a tratar
//En este caso busca "World" en la cadena de texto y lo sustituye por "Dolly"
/** Ejemplo de utilidad:
 * Disponemos de una cadena de texto que queremos usar como url
 * Cadena = "mi primera pagina web"
 * Necesito (url): "mi-primera-pagina-web"
 * echo str_replace(" ", "-", "mi primera pagina web");
 */
echo str_replace("World", "Dolly", "Hello World!");
            '); ?>
            <?php echo highlight_php_code('echo strrev("Hello World!"); // Invierte el orden de la cadena de texto'); ?>
            <?php echo highlight_php_code('
//Elimina espacios en blanco SÓLO por delante y detrás de la cadena de texto
//Los espacios intermedios NO los borra
echo trim(" Hello World! ");
            '); ?>
            <?php echo highlight_php_code('
//Convierte un string en un array
//1 param: Caracter por donde queremos cortar el string, en este caso, un espacio
//2 param: Indica el string a convertir
$y = explode(" ", "Hello World!"); //Obtenemos el array en la variable $y
print_r($y); //Imprimimos el array
            '); ?>
            <?php echo highlight_php_code('
//Extrae un substring del string principal
//1 param: String a cortar (original)
//2 param: La posición donde empiezo a cortar
//3 param: Es la longitud que voy a cortar (si no lo indico, será hasta el final)
//En este ejemplo, desde la posición 6, obtiene 5 caracteres.
echo "<br>".substr("Hello World!", 6, 5);
            '); ?>
        </div>

        <div id="numeros">
            <h2>Números</h2>
            <h3>Comprobar qué tipo de número es</h3>
            <h4>Enteros (Integers)</h4>
            <p>Se usa la función: `is_int()`</p>
            <?php echo highlight_php_code('$x = 5985; //Definimos un integer'); ?>
            <?php echo highlight_php_code('var_dump(is_int($x)); //Preguntamos si es integer -> Resultado: TRUE'); ?>
            <?php echo highlight_php_code('$x = 59.85; //Definimos un float'); ?>
            <?php echo highlight_php_code('var_dump(is_int($x)); //Preguntamos si es un integer -> Resultado: FALSE'); ?>

            <h4>Decimales (Floats)</h4>
            <p>Se usa la función: `is_float()`</p>
            <?php echo highlight_php_code('$x = 10.365; //Definimos un float'); ?>
            <?php echo highlight_php_code('var_dump(is_float($x)); //Preguntamos si es un float -> Resultado: TRUE'); ?>

            <h4>NaN (Not a Number)</h4>
            <p>Son valores No numéricos</p>
            <?php echo highlight_php_code('$x = acos(8);'); ?>
            <?php echo highlight_php_code('var_dump($x); // Resultado: float(NAN)'); ?>

            <h3>Comprobar si la variable es numérica: INT o un FLOAT</h3>
            <?php echo highlight_php_code('$x = 5985; //Definimos un entero'); ?>
            <?php echo highlight_php_code('var_dump(is_numeric($x)); //Preguntamos si es numérico -> Resultado: TRUE'); ?>
            <?php echo highlight_php_code('$x = "5985"; //Definimos un string numérico'); ?>
            <?php echo highlight_php_code('var_dump(is_numeric($x)); //Preguntamos si es numérico -> Resultado: TRUE'); ?>
            <?php echo highlight_php_code('$x = "Hello"; //Definimos un string no numérico'); ?>
            <?php echo highlight_php_code('var_dump(is_numeric($x)); //Preguntamos si es numérico -> Resultado: FALSE'); ?>

            <h3>CAST (Convertir números)</h3>
            <p>Podemos convertir un tipo de número en otro, reasignando el valor a la variable e indicando el nuevo tipo.</p>
            <p>Sintaxis: `$var_nueva = (nuevo_tipo_dato) $var_vieja;`</p>
            <?php echo highlight_php_code('$float = 50.598; //Definimos un float'); ?>
            <?php echo highlight_php_code('$int = (int) $float; //Convertimos de float a integer -> Resultado: 50'); ?>
            <p>Se pueden convertir todos los tipos de datos:</p>
            <ul>
                <li>de string a int</li>
                <li>de int a string</li>
                <li>de array a objeto</li>
                <li>etc...</li>
            </ul>

            <h3>Funciones Nativas Matemáticas</h3>
            <?php echo highlight_php_code('echo(pi()); // Imprime el número PI'); ?>
            <?php echo highlight_php_code('echo(min(0, 150, 30, 20, -8, -200)); // Imprime el mínimo de un conjunto de números'); ?>
            <?php echo highlight_php_code('echo(max(0, 150, 30, 20, -8, -200)); // Imprime el máximo de un conjunto de números'); ?>
            <?php echo highlight_php_code('echo(abs(-6.7)); // Imprime el número en valor absoluto'); ?>
            <?php echo highlight_php_code('echo(sqrt(64)); // Imprime la raíz cuadrada del valor (8)'); ?>
            <?php echo highlight_php_code('echo(round(0.49)); // Imprime el redondeo del valor (0)'); ?>
            <?php echo highlight_php_code('echo(round(0.51)); // Imprime el redondeo del valor (1)'); ?>
            <?php echo highlight_php_code('echo(rand()); // Imprime un número aleatorio'); ?>
            <?php echo highlight_php_code('
//Si se le dan parámetros, imprime números aleatorios en ese rango.
//En este ejemplo, imprime un número aleatorio entre 0 y 10
echo(rand(0, 10));
            '); ?>
        </div>

        <div id="constantes">
            <h2>Constantes</h2>
            <p>Son variables que no pueden cambiar su valor.</p>
            <ul>
                <li>Se definen una sola vez y duran durante todo el programa.</li>
                <li>Pueden ser de cualquier tipo de dato (int, float, string, array...).</li>
                <li>Son de ámbito global (accesibles desde cualquier parte).</li>
                <li>Se pueden declarar de dos formas: `define("NOMBRE", valor);` o `const NOMBRE = valor;`</li>
            </ul>
            <h3>Ejemplo con `define()`:</h3>
            <?php echo highlight_php_code('
define("GREETING", "Welcome to W3Schools.com!");
echo GREETING;
            '); ?>
            <h3>Ejemplo con `const`:</h3>
            <?php echo highlight_php_code('
const MYCAR = "Volvo";
echo MYCAR;
            '); ?>

            <h3>Constantes Mágicas</h3>
            <p>Son constantes predefinidas por PHP (son constantes nativas).</p>
            <ul>
                <li>`__CLASS__`: Si se usa dentro de una clase, devuelve el nombre de la clase.</li>
                <li>`__DIR__`: El directorio del archivo en ejecución en ese momento.</li>
                <li>`__FILE__`: El nombre del archivo (path completo).</li>
                <li>`__FUNCTION__`: Dentro de una función, devuelve el nombre de la función.</li>
                <li>`__LINE__`: Devuelve la línea actual de ejecución.</li>
                <li>`__METHOD__`: Si se usa dentro de una función, devuelve la clase y la función.</li>
                <li>`__NAMESPACE__`: Dentro de un namespace, devuelve el nombre del namespace (si aplica).</li>
                <li>`__TRAIT__`: Dentro de un trait, devuelve el nombre del trait (si aplica).</li>
                <li>`ClassName::class`: Devuelve el nombre de la clase (no es necesario estar dentro de la clase).</li>
            </ul>
        </div>

        <div id="estructuras_condicionales">
            <h2>Estructuras condicionales</h2>
            <h3>IF</h3>
            <?php echo highlight_php_code('
if (5 > 1) //Compruebo si se cumple la condición
//Si es cierta (TRUE), se ejecuta el código entre llaves
{
    echo "Es mayor"; // Esto se ejecutará
}
            '); ?>
            <h3>IF...ELSE</h3>
            <p>La ejecución de los bloques son excluyentes, solo se ejecutará uno de ellos.</p>
            <?php echo highlight_php_code('
echo "<br>";
if (5 > 10) //Comprueba la condición
//Si SI es cierta (TRUE), ejecuta el bloque, sino comprueba la siguiente condición
{
    echo "Es mayor";
}
//Si NO es cierta (FALSE), ejecuta el bloque de código
else
{
    echo "No es mayor"; // Esto se ejecutará
}
            '); ?>

            <h3>IF...ELSEIF...ELSE</h3>
            <?php echo highlight_php_code('
if (5 > 10) //Comprueba la condición
//SI es cierta, ejecuta el bloque, sino comprueba la siguiente condición
{
    // Código si 5 es mayor que 10
}
//Comprueba la condición, si es cierta ejecuta el bloque, sino pasa al siguiente
//Pueden existir infinitos bloques ELSEIF
elseif (5 > 6)
{
    // Código si 5 es mayor que 6 (lo cual tampoco es cierto)
}
else // Ejecución por defecto, cuando no se cumple ninguna condición anterior
{
    echo "Ninguna condición anterior fue verdadera."; // Esto se ejecutará
}
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
