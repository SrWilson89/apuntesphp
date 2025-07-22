<?php
/*
========================================
EJERCICIOS DE ESTRUCTURAS DE CONTROL EN PHP
========================================
*/

echo "<h1>Ejercicios de Estructuras de Control en PHP</h1>";

// Ejercicio 1
echo "<h2>1. Verificación de edad</h2>";
$edad = 20;
if ($edad >= 18) {
    echo "Eres mayor de edad (Edad: $edad)";
} else {
    echo "Eres menor de edad (Edad: $edad)";
}

// Ejercicio 2
echo "<h2>2. Evaluación de notas</h2>";
$nota = 6;
if ($nota >= 5) {
    echo "Aprobado (Nota: $nota)";
} else {
    echo "Suspendido (Nota: $nota)";
}

// Ejercicio 3
echo "<h2>3. Evaluación de temperatura</h2>";
$temperatura = 15;
if ($temperatura < 0) {
    echo "Hace mucho frío ($temperatura °C)";
} elseif ($temperatura >= 0 && $temperatura <= 20) {
    echo "Hace fresco ($temperatura °C)";
} else {
    echo "Hace calor ($temperatura °C)";
}

// Ejercicio 4
echo "<h2>4. Días de la semana con switch</h2>";
$dia = 3;
switch ($dia) {
    case 1:
        echo "Lunes";
        break;
    case 2:
        echo "Martes";
        break;
    case 3:
        echo "Miércoles";
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
        echo "Número no válido";
}

// Ejercicio 5
echo "<h2>5. Menú de bebidas</h2>";
$opcion = 'B';
switch ($opcion) {
    case 'A':
        echo "Has elegido café";
        break;
    case 'B':
        echo "Has elegido té";
        break;
    case 'C':
        echo "Has elegido agua";
        break;
    default:
        echo "Opción no válida";
}

// Ejercicio 6
echo "<h2>6. Contador del 1 al 10 (while)</h2>";
$contador = 1;
while ($contador <= 10) {
    echo "$contador ";
    $contador++;
}

// Ejercicio 7
echo "<h2>7. Números pares del 1 al 20 (while)</h2>";
$numero = 1;
while ($numero <= 20) {
    if ($numero % 2 == 0) {
        echo "$numero ";
    }
    $numero++;
}

// Ejercicio 8
echo "<h2>8. Do-while con mensaje único</h2>";
$mostrar = false;
do {
    echo "Bienvenido ";
    $mostrar = false; // Forzamos que solo se ejecute una vez
} while ($mostrar);

// Ejercicio 9
echo "<h2>9. Suma acumulativa con do-while</h2>";
$suma = 0;
$i = 1;
do {
    $suma += $i;
    $i++;
} while ($i <= 5);
echo "La suma total es: $suma";

// Ejercicio 10
echo "<h2>10. Adivina el número secreto</h2>";
$numeroSecreto = 7;
$intento = 5; // Simulamos intentos del usuario

do {
    if ($intento < $numeroSecreto) {
        echo "$intento es muy bajo. Intenta otra vez.<br>";
        $intento++; // Simulamos nuevo intento
    } elseif ($intento > $numeroSecreto) {
        echo "$intento es muy alto. Intenta otra vez.<br>";
        $intento--; // Simulamos nuevo intento
    }
} while ($intento != $numeroSecreto);

echo "¡Correcto! El número secreto era $numeroSecreto";

echo "<style>
    body { font-family: Arial, sans-serif; line-height: 1.6; padding: 20px; }
    h1 { color: #2c3e50; border-bottom: 2px solid #3498db; }
    h2 { color: #16a085; margin-top: 30px; }
    pre { background: #f4f4f4; padding: 10px; border-radius: 5px; }
</style>";
?>


<?php

// 🧮 Ejercicio 1: Sumar los elementos de un array
$numeros = [2, 4, 6, 8, 10];
$suma = 0;

foreach ($numeros as $num) {
    $suma += $num;
}

echo "<h3>Ejercicio 1: Sumar los elementos de un array</h3>";
echo "La suma total es: $suma<br><br>";

// 🔤 Ejercicio 2: Mostrar los elementos de un array asociativo
$persona = [
    "nombre" => "Laura",
    "edad" => 28,
    "ciudad" => "Toledo"
];

echo "<h3>Ejercicio 2: Mostrar los elementos de un array asociativo</h3>";
foreach ($persona as $clave => $valor) {
    echo "$clave: $valor<br>";
}
echo "<br>";

// 🗂️ Ejercicio 3: Ordenar un array de números
$valores = [9, 3, 5, 1, 4];

sort($valores); // Orden ascendente

echo "<h3>Ejercicio 3: Ordenar un array de números</h3>";
echo "Array ordenado: ";
foreach ($valores as $v) {
    echo "$v ";
}
echo "<br><br>";

// 📋 Ejercicio 4: Contar elementos mayores que un valor
$numeros = [15, 22, 8, 30, 10];
$contador = 0;

foreach ($numeros as $n) {
    if ($n > 10) {
        $contador++;
    }
}

echo "<h3>Ejercicio 4: Contar elementos mayores que un valor</h3>";
echo "Hay $contador número(s) mayores que 10.<br><br>";

// 📚 Ejercicio 5: Filtrar palabras según longitud
$palabras = ["sol", "montaña", "cielo", "agua", "infinito"];
$filtradas = [];

foreach ($palabras as $p) {
    if (strlen($p) > 5) {
        $filtradas[] = $p;
    }
}

echo "<h3>Ejercicio 5: Filtrar palabras según longitud</h3>";
echo "Palabras con más de 5 letras: " . implode(", ", $filtradas);

?>
