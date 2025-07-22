<?php

// index.php

// Incluimos nuestras clases
require_once 'Test.php';
require_once 'Question.php';

// Ruta a los archivos de datos
const QUESTIONS_FILE = 'questions.txt';
const SCORES_FILE = 'scores.txt';
const COOKIE_NAME = 'quiz_state';

session_start(); // Usaremos sesiones para un manejo más robusto de los datos del test en el servidor

$test = null;
$message = '';

// --- Lógica de recuperación o inicio del test ---
if (isset($_POST['start_test'])) {
    // Intentar iniciar un nuevo test
    $playerName = filter_input(INPUT_POST, 'player_name', FILTER_SANITIZE_STRING);
    if (!empty($playerName)) {
        $test = new Test($playerName);
        try {
            $test->loadRandomQuestions(QUESTIONS_FILE);
            $_SESSION['current_test'] = serialize($test); // Guardar el test en sesión
            // También se podría guardar en cookie si la sesión no es suficiente
            // setcookie(COOKIE_NAME, serialize($test), time() + (86400 * 30), "/"); // 30 días
            header("Location: index.php"); // Redirigir para evitar reenvío de formulario
            exit();
        } catch (Exception $e) {
            $message = "Error al cargar preguntas: " . $e->getMessage();
            // Si hay un error, no hay test válido, así que lo borramos de la sesión
            unset($_SESSION['current_test']);
            // setcookie(COOKIE_NAME, "", time() - 3600, "/"); // Borrar cookie antigua
        }
    } else {
        $message = "Por favor, introduce tu nombre para empezar el test.";
    }
} elseif (isset($_SESSION['current_test'])) {
    // Recuperar el test de la sesión si existe
    $test = unserialize($_SESSION['current_test']);

    // Comprobar si el test está completo y no se ha redirigido aún
    if ($test instanceof Test && $test->isCompleted) {
        // Asegurarse de que el resultado se guarda solo una vez
        if (!isset($_SESSION['test_result_saved'])) {
            $test->saveGameResult(SCORES_FILE);
            $_SESSION['test_result_saved'] = true;
        }
    }
    // Si no es una instancia válida de Test (ej. archivo modificado), resetear
    if (!$test instanceof Test) {
        unset($_SESSION['current_test']);
        $message = "Error al recuperar el test. Por favor, comienza de nuevo.";
        $test = null;
    }

} elseif (isset($_COOKIE[COOKIE_NAME])) {
    // Si no está en sesión, intentar recuperar de la cookie (opcional, sesión es más robusta)
    // Esto es para la recuperación "a medio hacer" si la sesión expirara
    $test = unserialize($_COOKIE[COOKIE_NAME]);
    if ($test instanceof Test) {
        $_SESSION['current_test'] = serialize($test); // Pasar a sesión para manejarlo mejor
        setcookie(COOKIE_NAME, "", time() - 3600, "/"); // Borrar cookie antigua si ya está en sesión
    } else {
        setcookie(COOKIE_NAME, "", time() - 3600, "/"); // Borrar cookie inválida
        $message = "Error al recuperar el test guardado. Por favor, empieza uno nuevo.";
        $test = null;
    }
}


// --- Lógica de navegación y respuestas del test ---
if ($test instanceof Test && !$test->isCompleted) {
    if (isset($_POST['submit_answer'])) {
        $selectedOption = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_STRING);
        $test->recordAnswer($selectedOption);
        $test->nextQuestion();
        $_SESSION['current_test'] = serialize($test); // Guardar estado actualizado
        // setcookie(COOKIE_NAME, serialize($test), time() + (86400 * 30), "/"); // Guardar en cookie
        header("Location: index.php"); // Redirigir para evitar reenvío de formulario
        exit();
    } elseif (isset($_POST['prev_question'])) {
        $test->prevQuestion();
        $_SESSION['current_test'] = serialize($test);
        // setcookie(COOKIE_NAME, serialize($test), time() + (86400 * 30), "/");
        header("Location: index.php");
        exit();
    }
}

// --- Lógica para reiniciar el test desde el resultado final ---
if ($test instanceof Test && $test->isCompleted && isset($_POST['restart_test'])) {
    unset($_SESSION['current_test']);
    unset($_SESSION['test_result_saved']);
    // setcookie(COOKIE_NAME, "", time() - 3600, "/"); // Borrar la cookie si se usó
    header("Location: index.php");
    exit();
}

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
        <?php if (!empty($message)): ?>
            <p style="color: red; text-align: center;"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if ($test === null || !$test instanceof Test): ?>
            <h1>Bienvenido al Test Online</h1>
            <form action="index.php" method="POST" class="start-form">
                <label for="player_name">Introduce tu nombre:</label>
                <input type="text" id="player_name" name="player_name" required>
                <button type="submit" name="start_test">Comenzar Test</button>
            </form>
            <?php
            // Opcional: Mostrar botón para recuperar test si hay una cookie (menos prioridad si hay sesión)
            /*
            if (isset($_COOKIE[COOKIE_NAME])) {
                echo '<p class="center-text" style="margin-top: 20px;">
                        <form action="index.php" method="POST">
                            <button type="submit" name="recover_test">Recuperar test anterior</button>
                        </form>
                      </p>';
            }
            */
            ?>
        <?php elseif ($test->isCompleted): ?>
            <h1>Resultados del Test</h1>
            <div class="result-summary">
                <p><strong>Jugador:</strong> <?php echo htmlspecialchars($test->playerName); ?></p>
                <p><strong>Preguntas acertadas:</strong> <?php echo $test->getCorrectAnswersCount(); ?> / <?php echo count($test->questions); ?></p>
                <p><strong>Porcentaje de aciertos:</strong> <?php echo number_format($test->getScorePercentage(), 2); ?>%</p>
                <p><strong>Tiempo total:</strong> <?php echo $test->getTestDuration(); ?></p>
            </div>
            <div class="center-text">
                <form action="index.php" method="POST">
                    <button type="submit" name="restart_test">Hacer otro Test</button>
                </form>
            </div>
        <?php else: ?>
            <h2>Pregunta <?php echo ($test->currentQuestionIndex + 1); ?> de <?php echo count($test->questions); ?></h2>
            <?php $currentQuestion = $test->getCurrentQuestion(); ?>
            <?php if ($currentQuestion): ?>
                <p><?php echo htmlspecialchars($currentQuestion->text); ?></p>
                <form action="index.php" method="POST" class="question-form">
                    <?php
                    // Las opciones ya están en un array en Question, ahora las mezclamos para que no salgan en el mismo orden
                    $optionsWithKeys = [];
                    foreach ($currentQuestion->options as $option) {
                        // Usamos el texto de la opción como clave para la respuesta, para ser flexibles.
                        // Podríamos usar letras (A,B,C,D) pero así es más directo.
                        $optionsWithKeys[] = $option;
                    }
                    shuffle($optionsWithKeys); // Mezcla el orden de las opciones para cada pregunta

                    $currentAnswer = $test->playerAnswers[$test->currentQuestionIndex] ?? '';

                    foreach ($optionsWithKeys as $option):
                        $uniqueId = 'option_' . uniqid(); // Asegurar ID único
                    ?>
                        <label for="<?php echo $uniqueId; ?>">
                            <input type="radio"
                                   id="<?php echo $uniqueId; ?>"
                                   name="answer"
                                   value="<?php echo htmlspecialchars($option); ?>"
                                   <?php echo ($currentAnswer === $option) ? 'checked' : ''; ?>
                                   required>
                            <?php echo htmlspecialchars($option); ?>
                        </label>
                    <?php endforeach; ?>

                    <div class="button-group">
                        <?php if ($test->currentQuestionIndex > 0): ?>
                            <button type="submit" name="prev_question">Anterior</button>
                        <?php else: ?>
                            <button type="button" disabled>Anterior</button>
                        <?php endif; ?>

                        <input type="submit" name="submit_answer" value="<?php echo ($test->currentQuestionIndex < count($test->questions) - 1) ? 'Siguiente' : 'Finalizar Test'; ?>">
                    </div>
                </form>
            <?php else: ?>
                <p class="center-text">No se pudo cargar la pregunta. Algo salió mal.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>