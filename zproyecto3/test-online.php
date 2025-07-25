<?php

// Anotación: Usar `require_once` es a menudo mejor para evitar errores si el archivo se incluye varias veces.
require_once "clases/pregunta.php"; // Anotación: Asegúrate de que la carpeta 'clases' exista y el archivo esté allí.

// Anotación General: Para un test online completo, necesitarás manejar el estado del usuario
// (qué pregunta está viendo, respuestas dadas, tiempo transcurrido) usando sesiones o cookies.
// También necesitarás un mecanismo para pasar de una pregunta a otra.

// --- 1. Guardar las preguntas (si el archivo preguntas.txt está vacío o se quiere resetear) ---
// Anotación: Este bucle creará y añadirá 10 preguntas cada vez que se ejecute test-online.php.
// Esto es útil para poblar el archivo al principio, pero en un entorno real, las preguntas
// no deberían generarse y guardarse en cada carga de página. Solo se harían una vez o a través
// de una interfaz de administración.
// Para evitar añadir preguntas repetidas cada vez que refrescas la página, podrías
// envolver esta lógica en una condición, por ejemplo, `if (!file_exists($preguntaManager->filename))`.

// La instancia de 'pregunta' aquí es solo para acceder a getAll y al filename.
// Anotación: Es una buena práctica crear una instancia de la clase 'pregunta'
// para que pueda acceder a sus métodos como 'getAll()' y 'filename'.
// Se usará una instancia "vacía" para fines de gestión de archivo.
$preguntaManager = new pregunta(null, "", [], 0);

// Solo guarda las preguntas si el archivo está vacío, para evitar duplicados en cada carga.
if (count($preguntaManager->getAll()) === 0) { // Anotación: Comprobamos si no hay preguntas ya guardadas.
    echo "<h1>Creando preguntas iniciales...</h1>";
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
            1 // Suponiendo que la Respuesta B es la correcta (índice 1)
        );
        $pregunta->save(); // Anotación: El método save() añade la pregunta al archivo.
    }
    echo "<p>Preguntas iniciales creadas y guardadas.</p>";
} else {
    echo "<h1>Preguntas ya existen en el archivo.</h1>";
}


echo "<h1>Listado de Preguntas Guardadas</h1>";

// --- 2. Recuperar todas las preguntas del archivo ---
// Anotación: Ahora sí recuperamos todas las preguntas existentes para mostrarlas.
$preguntas = $preguntaManager->getAll();

// --- 3. Mostrar las preguntas en HTML ---
if (count($preguntas) > 0) {
    echo "<h2>Total de preguntas: " . count($preguntas) . "</h2>";
    echo "<ol>"; // Lista ordenada para las preguntas
    foreach ($preguntas as $preguntaItem) {
        echo "<li>";
        // Anotación: htmlspecialchars() es CRÍTICO para prevenir ataques XSS (Cross-Site Scripting).
        // Siempre escapa cualquier salida de datos que provenga de fuentes externas (como un archivo de texto en este caso,
        // o entrada de usuario) antes de mostrarla en HTML.
        echo "<h3>" . htmlspecialchars($preguntaItem->pregunta) . " (ID: " . htmlspecialchars($preguntaItem->id_pregunta) . ")</h3>";
        echo "<ul>"; // Lista desordenada para las respuestas
        foreach ($preguntaItem->respuestas as $index => $respuesta) {
            echo "<li>" . htmlspecialchars($respuesta);
            if ($index == $preguntaItem->correcta) {
                echo " (Correcta)"; // Anotación: Esto es solo para depuración. En un test real no se mostraría cuál es la correcta.
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