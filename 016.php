<?php

echo "<h2>1. Función de Callback Simple:</h2>";
echo "Demostrando cómo una función simple puede ser pasada como callback a otra función." . "<br>";

// Función de callback simple
function miCallbackFuncion($item) {
    echo "Procesando elemento: " . $item . "<br>";
}

// Función que acepta un callback
function procesarArray(array $datos, callable $callback) {
    foreach ($datos as $valor) {
        call_user_func($callback, $valor);
    }
}

$frutas = ["manzana", "banana", "cereza"];
echo "Llamando a 'procesarArray' con 'miCallbackFuncion' y un array de frutas." . "<br>";
procesarArray($frutas, 'miCallbackFuncion');

?>

<hr>

<?php

echo "<h2>2. Usando una Función Anónima (Closure) como Callback:</h2>";
echo "Las funciones anónimas son muy comunes para callbacks ya que pueden definirse en línea." . "<br>";

// Función que acepta un callback
function ejecutarOperacion(int $a, int $b, callable $operacion) {
    echo "Ejecutando operación para $a y $b..." . "<br>";
    return call_user_func($operacion, $a, $b);
}

// Usando una función anónima para sumar
echo "Llamando a 'ejecutarOperacion' con una función anónima para sumar (5 + 3)." . "<br>";
$resultadoSuma = ejecutarOperacion(5, 3, function($x, $y) {
    return $x + $y;
});
echo "Resultado de la suma: " . $resultadoSuma . "<br>";

// Usando una función anónima para multiplicar
echo "Llamando a 'ejecutarOperacion' con una función anónima para multiplicar (5 * 3)." . "<br>";
$resultadoMultiplicacion = ejecutarOperacion(5, 3, function($x, $y) {
    return $x * $y;
});
echo "Resultado de la multiplicación: " . $resultadoMultiplicacion . "<br>";

?>

<hr>

<?php

echo "<h2>3. Usando un Método de Objeto como Callback:</h2>";
echo "Demostrando cómo un método de una clase puede ser usado como callback." . "<br>";

class Calculadora {
    public function sumar($a, $b) {
        return $a + $b;
    }

    public static function restar($a, $b) {
        return $a - $b;
    }
}

// Instanciando la clase
$calc = new Calculadora();

// Función que acepta un callback para realizar una operación
function realizarCalculo(int $num1, int $num2, callable $callback) {
    echo "Realizando cálculo para $num1 y $num2..." . "<br>";
    return call_user_func($callback, $num1, $num2);
}

echo "Llamando a 'realizarCalculo' con el método de objeto 'sumar' (10 + 5)." . "<br>";
$resObj = realizarCalculo(10, 5, [$calc, 'sumar']);
echo "Resultado usando método de objeto: " . $resObj . "<br>";

echo "Llamando a 'realizarCalculo' con el método estático 'restar' (10 - 5)." . "<br>";
$resStatic = realizarCalculo(10, 5, ['Calculadora', 'restar']); // O 'Calculadora::restar' en PHP 5.2.3+
echo "Resultado usando método estático: " . $resStatic . "<br>";

?>

<hr>

<?php

echo "<h2>4. Ejemplo de Callback con Funciones Integradas de PHP:</h2>";
echo "Demostrando el uso de callbacks con funciones PHP predefinidas como 'array_map'." . "<br>";

$numeros = [1, 2, 3, 4, 5];
echo "Array original: " . implode(", ", $numeros) . "<br>";

// Usando array_map con una función anónima para duplicar cada número
echo "Duplicando cada número del array usando 'array_map' con un callback anónimo." . "<br>";
$numerosDuplicados = array_map(function($n) {
    return $n * 2;
}, $numeros);
echo "Array duplicado: " . implode(", ", $numerosDuplicados) . "<br>";

// Usando array_map con una función definida por el usuario
function cuadrado($n) {
    return $n * $n;
}

echo "Calculando el cuadrado de cada número usando 'array_map' con un callback de función definida." . "<br>";
$numerosCuadrados = array_map('cuadrado', $numeros);
echo "Array con cuadrados: " . implode(", ", $numerosCuadrados) . "<br>";

?>