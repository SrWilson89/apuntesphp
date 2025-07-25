<?php
session_start();

require_once "clases/pregunta.php";
require_once "clases/TestManager.php";

$preguntaManager = new pregunta(null, "", [], 0);
$testManager = new TestManager();

// --- Configuración del Test ---
$total_preguntas = 10;
$preguntas_disponibles = $preguntaManager->getAll();

if (count($preguntas_disponibles) < $total_preguntas) {
    die("Error: No hay suficientes preguntas en 'preguntas.txt'. Se necesitan " . $total_preguntas . ".");
}

// Lógica para poblar el archivo 'preguntas.txt' solo si está vacío.
if (count($preguntaManager->getAll()) === 0) {
    echo "<h1>Creando preguntas iniciales...</h1>";
    for ($i = 0; $i < 10; $i++){
        $pregunta = new pregunta(
            null,
            "¿Esta es mi pregunta de prueba número " . ($i + 1) . "?",
            array("Respuesta A", "Respuesta B", "Respuesta C", "Respuesta D"),
            1
        );
        $pregunta->save();
    }
    echo "<p>Preguntas iniciales creadas y guardadas.</p>";
    header("Location: index.php"); // Redirigir para evitar duplicados y limpiar el estado POST
    exit();
}

// --- Variables de estado del Test - Aseguramos valores por defecto ---
$player_name = '';
$current_question_index = 0; // Anotación: Aseguramos su valor aquí de nuevo para máxima seguridad.
$user_answers = [];
$start_time = 0;
$preguntas_test = []; // Array de preguntas para el test actual.

// --- Lógica de Acciones (Ver resultados, limpiar, iniciar nuevo test) ---

// Anotación: Primero manejamos las acciones que llevan a una salida inmediata o una redirección.
if (isset($_POST['view_results'])) {
    mostrarPartidasGuardadas($testManager, $preguntaManager);
    exit();
}

if (isset($_POST['clear_results'])) {
    if ($testManager->clearGameResults()) {
        echo "<p style='color: green;' class='success-message'>¡Resultados de partidas limpiados correctamente!</p>";
    } else {
        echo "<p style='color: red;' class='error-message'>Error al limpiar los resultados de las partidas.</p>";
    }
    mostrarPartidasGuardadas($testManager, $preguntaManager); // Mostramos la tabla (ahora vacía)
    exit();
}

if (isset($_POST['start_new_test'])) {
    $testManager->clearTestProgress();
    header("Location: index.php");
    exit();
}

// --- Inicio o Reanudación del Test ---
$test_progress = $testManager->getTestProgress();

if ($test_progress) {
    // Anotación: Si hay progreso, rehidratamos las variables de estado.
    $player_name = $test_progress['player_name'] ?? '';
    $current_question_index = $test_progress['current_question_index'] ?? 0;
    $user_answers = $test_progress['user_answers'] ?? [];
    $start_time = $test_progress['start_time'] ?? time();
    $restored_question_ids = $test_progress['test_questions_ids'] ?? [];

    // Reconstruir el array de objetos pregunta en el orden guardado.
    foreach ($restored_question_ids as $id) {
        foreach ($preguntas_disponibles as $q) {
            if ($q->id_pregunta == $id) {
                $preguntas_test[] = $q;
                break;
            }
        }
    }

    // echo "<p>Progreso del test recuperado para: <strong>" . htmlspecialchars($player_name) . "</strong>. Reanudando desde la pregunta " . ($current_question_index + 1) . ".</p>";

} elseif (isset($_POST['start_test'])) {
    // Anotación: Primer inicio del test (después de enviar el nombre del jugador).
    $player_name = htmlspecialchars($_POST['player_name']);
    $start_time = time();

    // Seleccionar y mezclar preguntas para el nuevo test.
    shuffle($preguntas_disponibles);
    $preguntas_test = array_slice($preguntas_disponibles, 0, $total_preguntas);

    // Guardar el estado inicial del test en la cookie, incluyendo el orden de las preguntas.
    $testManager->saveTestProgress([
        'player_name' => $player_name,
        'current_question_index' => $current_question_index,
        'user_answers' => $user_answers,
        'start_time' => $start_time,
        'test_questions_ids' => array_map(function($q) { return $q->id_pregunta; }, $preguntas_test)
    ]);
} else {
    // Anotación: Si no hay progreso y no se ha iniciado el test, mostrar el formulario inicial.
    // También se puede poner el HTML directamente aquí si no hay más lógica PHP después.
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test Online</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <h1>Bienvenido al Test Online</h1>
            <form method='POST'>
                <label for='player_name'>Introduce tu nombre:</label>
                <input type='text' id='player_name' name='player_name' required>
                <br><br>
                <button type='submit' name='start_test'>Comenzar Test</button>
                <button type='submit' name='view_results'>Ver Partidas Guardadas</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit; // Importante: Salir después de mostrar el formulario inicial.
}

// --- Procesar respuesta a la pregunta actual (si se envió) ---
if (isset($_POST['submit_answer'])) {
    $question_index = (int)$_POST['question_index'];
    $selected_answer = (int)$_POST['answer'];

    $user_answers[$question_index] = $selected_answer;
    $current_question_index++;

    $testManager->saveTestProgress([
        'player_name' => $player_name,
        'current_question_index' => $current_question_index,
        'user_answers' => $user_answers,
        'start_time' => $start_time,
        'test_questions_ids' => array_map(function($q) { return $q->id_pregunta; }, $preguntas_test)
    ]);
}

// --- Inicio del HTML principal (si no hemos salido antes) ---
// Anotación: Todo el HTML de las preguntas y resultados se generará aquí.
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        // --- Lógica para mostrar la pregunta actual o el resultado final ---
        if ($current_question_index >= $total_preguntas) {
            // --- Página de Resultados Finales ---
            echo "<h1>¡Test Completado, " . htmlspecialchars($player_name) . "!</h1>";

            $correct_answers_count = 0;
            foreach ($user_answers as $q_index => $u_answer) {
                if (isset($preguntas_test[$q_index]) && $preguntas_test[$q_index]->correcta == $u_answer) {
                    $correct_answers_count++;
                }
            }

            $percentage = ($total_preguntas > 0) ? ($correct_answers_count / $total_preguntas) * 100 : 0;
            $time_taken = time() - $start_time;

            echo "<p>Número de preguntas acertadas: <strong>" . $correct_answers_count . " de " . $total_preguntas . "</strong></p>";
            echo "<p>Porcentaje de aciertos: <strong>" . number_format($percentage, 2) . "%</strong></p>";
            echo "<p>Tiempo total: <strong>" . gmdate("H:i:s", $time_taken) . "</strong></p>";

            // Anotación: Asegúrate de que TestManager::saveGameResult tiene 5 argumentos (incluyendo $total_preguntas)
            $testManager->saveGameResult($player_name, $correct_answers_count, $percentage, $time_taken, $total_preguntas);

            $testManager->clearTestProgress(); // Limpiar la cookie de progreso

            echo "<br><h2>Opciones:</h2>";
            echo "<form method='POST'>";
            echo "<button type='submit' name='view_results'>Ver Partidas Guardadas</button>";
            echo " <button type='submit' name='start_new_test'>Comenzar Nuevo Test</button>";
            echo "</form>";

        } else {
            // Anotación: Mostrar Pregunta Actual
            // La línea 135 se refiere a algo aquí o cerca de aquí. Con la nueva estructura,
            // $current_question_index debería estar siempre definido aquí.
            if (!isset($preguntas_test[$current_question_index])) {
                // Anotación: Esto es un caso de error grave, si no se puede cargar la pregunta.
                echo "<p class='error-message'>Error: No se pudo cargar la pregunta actual. Por favor, <a href='index.php?reset=true'>reinicia el test</a>.</p>";
                $testManager->clearTestProgress(); // Limpiar progreso para permitir un nuevo intento
            } else {
                $current_question = $preguntas_test[$current_question_index];

                echo "<h1>Pregunta " . ($current_question_index + 1) . " de " . $total_preguntas . "</h1>";
                echo "<h2>" . htmlspecialchars($current_question->pregunta) . "</h2>";

                echo "<form method='POST'>";
                echo "<input type='hidden' name='question_index' value='" . $current_question_index . "'>";

                $indexed_answers = [];
                foreach ($current_question->respuestas as $idx => $ans) {
                    $indexed_answers[] = ['index' => $idx, 'text' => $ans];
                }
                shuffle($indexed_answers);

                foreach ($indexed_answers as $ans) {
                    echo "<input type='radio' id='answer_" . $ans['index'] . "' name='answer' value='" . $ans['index'] . "' required>";
                    echo "<label for='answer_" . $ans['index'] . "'>" . htmlspecialchars($ans['text']) . "</label><br>";
                }
                echo "<br>";
                echo "<button type='submit' name='submit_answer'>Siguiente Pregunta</button>";
                echo "</form>";
            }
        }
        ?>
    </div> </body>
</html>
<?php

// Función auxiliar para mostrar la tabla de partidas guardadas.
// Anotación: Se mantiene fuera del HTML principal para una mejor organización.
function mostrarPartidasGuardadas(TestManager $testManager, pregunta $preguntaManager) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Partidas Guardadas</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <h1>Partidas Guardadas</h1>
            <?php
            $game_results = $testManager->getAllGameResults();

            if (count($game_results) > 0) {
                echo "<table border='1' cellpadding='5' cellspacing='0'>";
                echo "<thead><tr><th>Jugador</th><th>Aciertos</th><th>Porcentaje</th><th>Tiempo</th><th>Fecha</th></tr></thead>";
                echo "<tbody>";
                foreach ($game_results as $result) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($result['player_name'] ?? 'Desconocido') . "</td>";
                    echo "<td>" . htmlspecialchars($result['correct_answers'] ?? 'N/A') . "/" . ($result['total_questions'] ?? 10) . "</td>";
                    echo "<td>" . number_format($result['percentage'] ?? 0, 2) . "%</td>";
                    echo "<td>" . gmdate("H:i:s", $result['time_taken_seconds'] ?? 0) . "</td>";
                    echo "<td>" . htmlspecialchars($result['date'] ?? 'N/A') . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";

                echo "<br>";
                echo "<form method='POST'>";
                echo "<button type='submit' name='clear_results' onclick=\"return confirm('¿Estás seguro de que quieres borrar todos los resultados de las partidas?');\">Limpiar Partidas Guardadas</button>";
                echo " <button type='submit' name='start_new_test'>Comenzar Nuevo Test</button>";
                echo "</form>";

            } else {
                echo "<p>No hay partidas guardadas.</p>";
                echo "<form method='POST'>";
                echo "<button type='submit' name='start_new_test'>Comenzar Nuevo Test</button>";
                echo "</form>";
            }
            ?>
        </div>
    </body>
    </html>
    <?php
}
?>