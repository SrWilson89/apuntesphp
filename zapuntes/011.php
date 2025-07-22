<?php

//Añadir el archivo Car.php a este script
include "Car.php";
//require "Car2.php";

# http://localhost/repo/unitel-RubenUnitel/012%20-%20PHP/011%20-%20Avanzado%20PHP/avanzado.php

//Fechas
echo "Today is " . date("Y/m/d") . "<br>";
echo "Today is " . date("Y.m.d") . "<br>";
echo "Today is " . date("Y-m-d") . "<br>";
echo "Today is " . date("l") . "<br>";

//Hora
echo "The time is " . date("H:i:s") . "<br>";;

//Convertir fecha de string a fecha
$d = strtotime("10:30pm April 15 2014");
echo "Created date is " . date("Y-m-d h:i:sa", $d) . "<br>";;

//Creación de fechas
$d=strtotime("tomorrow");
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d=strtotime("next Saturday");
echo date("Y-m-d h:i:sa", $d) . "<br>";

$d=strtotime("+3 Months");
echo date("Y-m-d h:i:sa", $d) . "<br>";

//Cuenta atrás
$d1=strtotime("October 29");
$d2=ceil(($d1-time())/60/60/24);
echo "There are " . $d2 ." days until fin de curso." . "<br>";

//Include/Require
/**
 * require will produce a fatal error (E_COMPILE_ERROR) and stop the script
 * include will only produce a warning (E_WARNING) and the script will continue
 */
$myCar = new Car("Azul", "Ford");
echo "El coche es de color: ".$myCar->color."<br>";

//Lectura de archivo
echo  readfile("listado de codigos.txt");

//Apertura de archivo
$myfile = fopen("listado de codigos.txt", "r") or die("Unable to open file!");
echo fread($myfile,filesize("listado de codigos.txt"));
fclose($myfile);

//Lectura de archivo línea a línea
echo "<br><br>";
$myfile = fopen("listado de codigos.txt", "r") or die("Unable to open file!");
//echo fgets($myfile);
$lineas = array();
if ($myfile) {
    while (($buffer = fgets($myfile, filesize("listado de codigos.txt"))) !== false) {
        $lineas[] = $buffer;
    }
    if (!feof($myfile)) {
        echo "Error: fgets() falló\n";
    }
    fclose($myfile);
}
//Imprimir el archivo línea a línea
foreach ($lineas as $key => $value) {
    echo $value."<br>";
}

//Crear y escribir un archivo
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);
echo "Archivo creado!<br>";

//Añadir texto al archivo
$myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
$txt = "Donald Duck\n";
fwrite($myfile, $txt);
$txt = "Goofy Goof\n";
fwrite($myfile, $txt);
fclose($myfile);
echo "Archivo actualizado!<br>";

//Ejemplo de log
function addLog(string $str, int $severity = 0) : void
{
    $name_severity;
    switch ($severity)
    {
        case 0: 
            $name_severity = "INFO";
            break;
        case 1: 
            $name_severity = "PELIGRO";
            break;
        case 2: 
            $name_severity = "ERROR";
            break;
        case 3: 
            $name_severity = "CRITICAL";
            break;
    }

    //1. Abrir el archivo
    $myfile = fopen("log.txt", "a") or die("Unable to open file!");
    //2.Escribir
    fwrite($myfile, "[".date('d-m-Y H:i:s')."] "."[".$name_severity."] ".$str."\n");
    //3. Cerrar archivo
    fclose($myfile);
}

addlog("Hemos creado el primer registro del log.", 1);
addlog("Hemos añadido una nueva línea.", 0);