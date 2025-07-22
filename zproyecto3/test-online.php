<?php

require "clases/pregunta.php";

// 1. Guardar las preguntas (esto es lo que ya hacía el script)
for ($i = 0; $i < 10; $i++){
    $pregunta = new pregunta(
        null, // El ID se asignará automáticamente en save()
        "¿Esta es mi pregunta de prueba número " . ($i + 1) . "?", // Modificamos la pregunta para que sean distintas
        array(
            "Respuesta A",
            "Respuesta B",
            "Respuesta C",
            "Respuesta D",
        ),
        1 // Suponiendo que la Respuesta B es la correcta
    );

    $pregunta->save();
}

echo "<h1>Preguntas Creadas y Guardadas</h1>";

// 2. Recuperar todas las preguntas del archivo
$preguntaManager = new pregunta(null, "", [], 0); // Creamos una instancia "temporal" para acceder a getAll()
$preguntas = $preguntaManager->getAll();

// 3. Mostrar las preguntas en HTML
if (count($preguntas) > 0) {
    echo "<h2>Total de preguntas: " . count($preguntas) . "</h2>";
    echo "<ol>"; // Lista ordenada para las preguntas
    foreach ($preguntas as $preguntaItem) {
        echo "<li>";
        echo "<h3>" . htmlspecialchars($preguntaItem->pregunta) . "</h3>";
        echo "<ul>"; // Lista desordenada para las respuestas
        foreach ($preguntaItem->respuestas as $index => $respuesta) {
            echo "<li>" . htmlspecialchars($respuesta);
            if ($index == $preguntaItem->correcta) {
                echo " (Correcta)";
            }
            echo "</li>";
        }
        echo "</ul>";
        echo "</li>";
    }
    echo "</ol>";
} else {
    echo "<p>No hay preguntas disponibles.</p>";
}

?>
