<?php
session_start();

// --- Configuración del Tablero y Barcos ---
const BOARD_SIZE = 10; // Tablero de 10x10

// Definición de los barcos (nombre, tamaño)
$ships_config = [
    'portaaviones' => 5,
    'acorazado' => 4,
    'submarino' => 3,
    'destructor' => 3,
    'patrullero' => 2
];

// --- Funciones del Juego ---

/**
 * Inicializa el tablero y posiciona los barcos aleatoriamente.
 * @return array Un array con el tablero de juego y la info de los barcos.
 */
function initializeBoard($ships_config) {
    $board = [];
    for ($r = 0; $r < BOARD_SIZE; $r++) {
        for ($c = 0; $c < BOARD_SIZE; $c++) {
            $board[$r][$c] = 'water'; // 'water', 'ship', 'hit', 'miss'
        }
    }

    $placed_ships = []; // Para almacenar la ubicación de cada pieza de barco
    $attempts_limit = 1000; // Límite para evitar bucles infinitos en el posicionamiento
    $current_attempts = 0;

    foreach ($ships_config as $ship_name => $ship_size) {
        $placed = false;
        while (!$placed && $current_attempts < $attempts_limit) {
            $row = rand(0, BOARD_SIZE - 1);
            $col = rand(0, BOARD_SIZE - 1);
            $direction = rand(0, 1); // 0 = horizontal, 1 = vertical

            $can_place = true;
            $temp_ship_positions = [];

            if ($direction == 0) { // Horizontal
                if ($col + $ship_size > BOARD_SIZE) {
                    $can_place = false;
                } else {
                    for ($i = 0; $i < $ship_size; $i++) {
                        // Verifica también las celdas adyacentes para evitar pegarse demasiado (opcional, pero mejor)
                        // Para simplificar, solo verificamos la celda actual
                        if ($board[$row][$col + $i] != 'water') {
                            $can_place = false;
                            break;
                        }
                        $temp_ship_positions[] = [$row, $col + $i];
                    }
                }
            } else { // Vertical
                if ($row + $ship_size > BOARD_SIZE) {
                    $can_place = false;
                } else {
                    for ($i = 0; $i < $ship_size; $i++) {
                        // Verifica también las celdas adyacentes (opcional)
                        if ($board[$row + $i][$col] != 'water') {
                            $can_place = false;
                            break;
                        }
                        $temp_ship_positions[] = [$row + $i, $col];
                    }
                }
            }

            if ($can_place) {
                foreach ($temp_ship_positions as $pos) {
                    $board[$pos[0]][$pos[1]] = $ship_name; // Marca la celda con el nombre del barco
                }
                $placed_ships[$ship_name] = [
                    'size' => $ship_size,
                    'hits' => 0,
                    'sunk' => false,
                    'positions' => $temp_ship_positions // Guarda las posiciones para checkear
                ];
                $placed = true;
            }
            $current_attempts++;
        }
        // Si no se pudo colocar un barco después de muchos intentos, considera un error o reinicio.
        // Para este ejemplo, si no se puede colocar, se devuelve un tablero vacío o se maneja el error.
        if (!$placed) {
            // Podrías lanzar una excepción o devolver false para indicar que falló
            // Para simplicidad, si no puede colocar, volvemos a intentar con un nuevo tablero
            // (esto puede generar un bucle infinito si los barcos son demasiado grandes para el tablero)
            error_log("No se pudo colocar el barco '{$ship_name}'. Reiniciando colocación.");
            return initializeBoard($ships_config); // Recursión, ¡cuidado con el stack overflow si el tablero es muy pequeño!
        }
    }
    // Devolvemos el tablero y los barcos colocados
    return ['board' => $board, 'ships' => $placed_ships];
}

/**
 * Verifica si todos los barcos han sido hundidos.
 * @param array $ships Información de los barcos.
 * @return bool True si todos los barcos están hundidos, False en caso contrario.
 */
function checkGameOver($ships) {
    if (!is_array($ships)) { // Doble verificación para evitar errores si $ships es null/no array
        return true; // Si no hay barcos (error de inicialización), se podría considerar como juego terminado
    }
    foreach ($ships as $ship) {
        if (!$ship['sunk']) {
            return false;
        }
    }
    return true;
}

// --- Inicialización o Reinicio del Juego ---
if (!isset($_SESSION['board']) || !isset($_SESSION['ships']) || isset($_GET['reset'])) {
    $initial_game_state = initializeBoard($ships_config);
    $_SESSION['board'] = $initial_game_state['board'];
    $_SESSION['ships'] = $initial_game_state['ships']; // Asegúrate de que $_SESSION['ships'] se setea aquí
    $_SESSION['game_over'] = false;
    $_SESSION['message'] = '¡Hunde la flota! Dispara en el tablero.';
    $_SESSION['shots_fired'] = 0;
}

// Asignar referencias AHORA que sabemos que existen
$board = &$_SESSION['board'];
$ships = &$_SESSION['ships']; // Esta es la clave: $ships DEBE ser un array
$game_over = &$_SESSION['game_over'];
$message = &$_SESSION['message'];
$shots_fired = &$_SESSION['shots_fired'];

// --- Manejo del Disparo (Click en una celda) ---
if (isset($_GET['r']) && isset($_GET['c']) && !$game_over) {
    $row = (int)$_GET['r'];
    $col = (int)$_GET['c'];

    // Validar coordenadas
    if ($row >= 0 && $row < BOARD_SIZE && $col >= 0 && $col < BOARD_SIZE) {
        $shots_fired++;
        $current_cell_status = $board[$row][$col];

        // Usamos switch para mejorar la legibilidad
        switch ($current_cell_status) {
            case 'hit':
            case 'miss':
            case 'sunk': // Si ya se hundió y se vuelve a disparar
                $message = 'Ya disparaste en la casilla (' . ($row+1) . ',' . chr(65 + $col) . '). Elige otra.';
                // Ajustamos el contador de disparos si el disparo no cuenta
                $shots_fired--;
                break;
            case 'water':
                $board[$row][$col] = 'miss';
                $message = '¡Agua! en ' . chr(65 + $col) . ($row+1) . '.';
                break;
            default: // Es una pieza de barco (tendrá el nombre del barco)
                $ship_name_hit = $current_cell_status;
                $board[$row][$col] = 'hit'; // Marca la celda como impactada
                if (isset($ships[$ship_name_hit])) { // Asegurarse de que el barco existe en el array $ships
                    $ships[$ship_name_hit]['hits']++; // Incrementa los impactos del barco
                    $message = '¡Impacto! en ' . chr(65 + $col) . ($row+1) . '.';

                    // Verificar si el barco se hundió
                    if ($ships[$ship_name_hit]['hits'] == $ships[$ship_name_hit]['size']) {
                        $ships[$ship_name_hit]['sunk'] = true;
                        $message .= ' ¡Has hundido el ' . ucfirst($ship_name_hit) . '!';

                        // Marcar las celdas del barco hundido como 'sunk' para visualización
                        foreach($ships[$ship_name_hit]['positions'] as $pos) {
                            $board[$pos[0]][$pos[1]] = 'sunk';
                        }
                    }
                } else {
                    $message = 'Error: Barco desconocido impactado. (' . chr(65 + $col) . ($row+1) . ')';
                }
                break;
        }

        // Verificar si el juego terminó
        if (checkGameOver($ships)) {
            $game_over = true;
            $message = '¡Felicidades! ¡Has hundido toda la flota en ' . $shots_fired . ' disparos!';
        }
    } else {
        $message = 'Coordenadas inválidas.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hundir la Flota</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Hundir la Flota</h1>
        <div class="message <?php echo $game_over ? 'game-over' : ''; ?>">
            <?php echo $message; ?>
        </div>
        <div class="game-info">
            Disparos: **<?php echo $shots_fired; ?>** | Barcos restantes: **<?php echo count(array_filter($ships, fn($s) => !$s['sunk'])); ?>**
        </div>

        <div class="board-grid">
            <div class="grid-header-corner"></div>
            <?php for ($c = 0; $c < BOARD_SIZE; $c++): ?>
                <div class="grid-header-col"><?php echo $c + 1; ?></div>
            <?php endfor; ?>

            <?php for ($r = 0; $r < BOARD_SIZE; $r++): ?>
                <div class="grid-header-row"><?php echo chr(65 + $r); ?></div>
                <?php for ($c = 0; $c < BOARD_SIZE; $c++):
                    $cell_status = $board[$r][$c];
                    $cell_class = $cell_status; // 'water', 'hit', 'miss', 'sunk', o nombre_del_barco
                    $display_char = ''; // Lo que se muestra en la celda
                    // En un juego real, 'ship' nunca se mostraría a menos que se esté depurando
                    if ($cell_status == 'hit') {
                        $display_char = 'X';
                    } elseif ($cell_status == 'miss') {
                        $display_char = 'O';
                    } elseif ($cell_status == 'sunk') {
                         $display_char = '🔥'; // Emoji para barco hundido
                    }

                    // Enlaces para disparar
                    $link_href = "?r={$r}&c={$c}";
                    if ($game_over || $cell_status == 'hit' || $cell_status == 'miss' || $cell_status == 'sunk') {
                        $link_href = '#'; // Deshabilita el enlace si ya se disparó o el juego terminó
                        $cell_class .= ' disabled';
                    }
                ?>
                    <a href="<?php echo $link_href; ?>" class="cell <?php echo $cell_class; ?>">
                        <?php echo $display_char; ?>
                    </a>
                <?php endfor; ?>
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