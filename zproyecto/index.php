<?php
session_start();
require_once 'Test.php';
require_once 'Question.php';

// Cargar preguntas desde archivo
$questions = [];
$lines = file('questions.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    list($text, $options, $correct) = explode('|', $line);
    $questions[] = new Question($text, explode(',', $options), $correct);
}
shuffle($questions);
$questions = array_slice($questions, 0, 10);

// Inicializar o recuperar test
$test = isset($_COOKIE['test']) ? unserialize(base64_decode($_COOKIE['test'])) : new Test();
if (!isset($_COOKIE['player'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['player'])) {
        setcookie('player', $_POST['player'], time() + 3600);
        $_COOKIE['player'] = $_POST['player'];
        $test->startTime = time();
    } else {
        echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Test Online</title><link rel="stylesheet" href="styles.css"></head><body>';
        echo '<div class="container"><form method="post"><label>Nombre: <input type="text" name="player" required></label><button type="submit">Iniciar</button></form></div>';
        echo '</body></html>';
        exit;
    }
}

// Procesar respuesta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $test->answer($_POST['answer']);
    setcookie('test', base64_encode(serialize($test)), time() + 3600);
}

// Reiniciar test si se solicita
if (isset($_POST['reset'])) {
    $test = new Test();
    setcookie('test', base64_encode(serialize($test)), time() + 3600);
    header('Location: index.php');
    exit;
}

// Mostrar pregunta o resultados
$current = $test->currentQuestion;
echo '<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>Test Online</title><link rel="stylesheet" href="styles.css"></head><body>';
echo '<div class="container"><h1>Test Online - ' . htmlspecialchars($_COOKIE['player']) . '</h1>';

if ($current < 10) {
    $q = $questions[$current];
    echo "<h2>Pregunta " . ($current + 1) . ": {$q->text}</h2><form method='post'>";
    foreach ($q->options as $i => $opt) {
        echo "<label><input type='radio' name='answer' value='$i' required>$opt</label><br>";
    }
    echo '<button type="submit">Responder</button></form>';
} else {
    $score = $test->getScore($questions);
    $percentage = ($score / 10) * 100;
    $time = time() - $test->startTime;
    file_put_contents('scores.txt', "{$_COOKIE['player']},$score,$percentage%,$time segundos\n", FILE_APPEND);
    
    echo "<h2>Resultados</h2>";
    echo "<p>Aciertos: $score/10</p>";
    echo "<p>Porcentaje: $percentage%</p>";
    echo "<p>Tiempo: $time segundos</p>";
    echo '<form method="post"><button type="submit" name="reset">Reiniciar</button></form>';
    
    setcookie('test', '', time() - 3600);
    setcookie('player', '', time() - 3600);
}

echo '</div></body></html>';
?>