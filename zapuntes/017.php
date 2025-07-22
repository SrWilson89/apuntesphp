<?php

echo "<h2>1. Codificar un Array PHP a JSON (json_encode()):</h2>";
echo "Convirtiendo un array asociativo PHP en una cadena de texto JSON." . "<br>";

$edad = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

echo "Array PHP original:<br>";
print_r($edad);
echo "<br><br>";

$json_edad = json_encode($edad);

echo "Resultado JSON de la codificación:<br>";
echo $json_edad . "<br>";

?>

<hr>

<?php

echo "<h2>2. Codificar un Objeto PHP a JSON (json_encode()):</h2>";
echo "Convirtiendo un objeto PHP en una cadena de texto JSON." . "<br>";

class Persona {
    public $nombre;
    public $edad;

    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }
}

$persona = new Persona("Alice", 30);

echo "Objeto PHP original:<br>";
print_r($persona);
echo "<br><br>";

$json_persona = json_encode($persona);

echo "Resultado JSON de la codificación:<br>";
echo $json_persona . "<br>";

?>

<hr>

<?php

echo "<h2>3. Decodificar JSON a un Objeto PHP (json_decode()):</h2>";
echo "Convirtiendo una cadena JSON en un objeto PHP estándar." . "<br>";

$json_cadena_objeto = '{"Peter":35,"Ben":37,"Joe":43}';

echo "Cadena JSON original:<br>";
echo $json_cadena_objeto . "<br><br>";

$obj_edades = json_decode($json_cadena_objeto);

echo "Resultado después de decodificar (como objeto PHP):<br>";
print_r($obj_edades);
echo "<br>";
echo "Accediendo a un valor (ej. Peter): " . $obj_edades->Peter . "<br>";


?>

<hr>

<?php

echo "<h2>4. Decodificar JSON a un Array Asociativo PHP (json_decode() con 'true'):</h2>";
echo "Convirtiendo una cadena JSON en un array asociativo PHP." . "<br>";

$json_cadena_array = '{"Peter":35,"Ben":37,"Joe":43}';

echo "Cadena JSON original:<br>";
echo $json_cadena_array . "<br><br>";

$arr_edades = json_decode($json_cadena_array, true); // El 'true' es crucial aquí

echo "Resultado después de decodificar (como array asociativo PHP):<br>";
print_r($arr_edades);
echo "<br>";
echo "Accediendo a un valor (ej. Peter): " . $arr_edades['Peter'] . "<br>";

?>

<hr>

<?php

echo "<h2>5. Decodificar JSON con Bucle (foreach):</h2>";
echo "Iterando sobre los datos decodificados de JSON." . "<br>";

$json_data = '{"Maria":28,"Carlos":45,"Ana":22}';

echo "Cadena JSON a decodificar:<br>";
echo $json_data . "<br><br>";

$data_decoded = json_decode($json_data, true); // Decodificar a array asociativo para fácil iteración

echo "Recorriendo los datos decodificados:<br>";
foreach ($data_decoded as $clave => $valor) {
    echo $clave . " tiene " . $valor . " años.<br>";
}

?>