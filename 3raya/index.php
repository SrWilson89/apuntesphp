<?php
session_start(); // Inicia la sesión para mantener el estado del juego

// Inicializa el tablero si no existe en la sesión o si se ha reiniciado el juego
if (!isset($_SESSION['board']) || isset($_GET['reset'])) {
    $_SESSION['board'] = array_fill(0, 9, ''); // Array de 9 elementos vacíos para el tablero
    $_SESSION['player'] = 'X'; // El jugador inicial es 'X'
    $_SESSION['game_over'] = false; // El juego no ha terminado
    $_SESSION['message'] = 'Turno del Jugador X'; // Mensaje inicial
}

$board = &$_SESSION['board'];
$player = &$_SESSION['player'];
$game_over = &$_SESSION['game_over'];
$message = &$_SESSION['message'];

// Función para verificar si hay un ganador
function checkWinner($board) {
    $winning_combinations = [
        [0, 1, 2], [3, 4, 5], [6, 7, 8], // Filas
        [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columnas
        [0, 4, 8], [2, 4, 6]             // Diagonales
    ];

    foreach ($winning_combinations as $combo) {
        if ($board[$combo[0]] != '' &&
            $board[$combo[0]] == $board[$combo[1]] &&
            $board[$combo[1]] == $board[$combo[2]]) {
            return $board[$combo[0]]; // Retorna el símbolo del ganador ('X' o 'O')
        }
    }
    return false; // No hay ganador
}

// Función para verificar si hay empate
function checkTie($board) {
    foreach ($board as $cell) {
        if ($cell == '') {
            return false; // Todavía hay celdas vacías, no es empate
        }
    }
    return true; // Todas las celdas están llenas y no hay ganador
}

// Maneja el clic en una celda
if (isset($_GET['cell']) && !$game_over) {
    $cell_id = (int)$_GET['cell'];

    if ($board[$cell_id] == '') { // Si la celda está vacía
        $board[$cell_id] = $player; // Coloca el símbolo del jugador actual

        $winner = checkWinner($board);
        if ($winner) {
            $message = "¡Jugador {$winner} ha ganado!";
            $game_over = true;
        } elseif (checkTie($board)) {
            $message = "¡Es un empate!";
            $game_over = true;
        } else {
            // Cambia de jugador
            $player = ($player == 'X') ? 'O' : 'X';
            $message = "Turno del Jugador {$player}";
        }
    } else {
        $message = "¡Esa celda ya está ocupada!";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tres en Raya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tres en Raya</h1>
        <div class="message <?php echo $game_over ? 'game-over' : ''; ?>">
            <?php echo $message; ?>
        </div>
        <div class="board">
            <?php for ($i = 0; $i < 9; $i++): ?>
                <a href="?cell=<?php echo $i; ?>" class="cell <?php echo $board[$i] == 'X' ? 'player-x' : ($board[$i] == 'O' ? 'player-o' : ''); ?> <?php echo $game_over ? 'disabled' : ''; ?>">
                    <?php echo $board[$i]; ?>
                </a>
            <?php endfor; ?>
        </div>
        <div class="controls">
            <a href="?reset=true" class="reset-button">Reiniciar Juego</a>
        </div>
    <?php
    // En 3raya/index.php, ajedrez/index.php, etc.

    // ... Tu código PHP

    // Incluir el footer.php que está un nivel arriba
    include '../footer.php';

    // O, si quieres asegurarte de que solo se incluya una vez y parar la ejecución si no se encuentra:
    // require_once '../footer.php';
    ?>
    </div>

</body>
</html>