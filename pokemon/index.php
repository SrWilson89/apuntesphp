<?php
session_start();

// --- Configuración del Juego ---
const TILE_SIZE = 32; // Tamaño de cada tile en píxeles (ej. 32x32)
const MAP_WIDTH_TILES = 10; // Ancho del mapa en tiles
const MAP_HEIGHT_TILES = 10; // Alto del mapa en tiles

$mapFile = 'map.json'; // Archivo donde se define la estructura del mapa
$saveFile = 'savegame.json'; // Archivo para guardar la posición del jugador

// --- Funciones de Utilidad ---

/**
 * Carga la estructura del mapa desde un archivo JSON.
 * Si el archivo no existe o está vacío, crea un mapa de ejemplo.
 * @param string $filePath Ruta al archivo JSON del mapa.
 * @return array La estructura del mapa.
 */
function loadMap($filePath) {
    if (file_exists($filePath) && filesize($filePath) > 0) {
        $json = file_get_contents($filePath);
        return json_decode($json, true);
    }
    // Mapa de ejemplo si el archivo no existe o está vacío
    $exampleMap = [];
    for ($y = 0; $y < MAP_HEIGHT_TILES; $y++) {
        for ($x = 0; $x < MAP_WIDTH_TILES; $x++) {
            // 'grass' por defecto, 'tree' en los bordes
            if ($x == 0 || $x == MAP_WIDTH_TILES - 1 || $y == 0 || $y == MAP_HEIGHT_TILES - 1) {
                $exampleMap[$y][$x] = 'tree';
            } else {
                $exampleMap[$y][$x] = 'grass';
            }
        }
    }
    // Añadir un "camino" simple
    for ($i = 2; $i < MAP_WIDTH_TILES - 2; $i++) {
        $exampleMap[MAP_HEIGHT_TILES / 2][$i] = 'path';
    }
    // Guardar el mapa de ejemplo para futuras cargas
    file_put_contents($filePath, json_encode($exampleMap, JSON_PRETTY_PRINT));
    return $exampleMap;
}

/**
 * Carga la posición guardada del jugador.
 * @param string $filePath Ruta al archivo JSON de guardado.
 * @return array La posición del jugador (x, y).
 */
function loadPlayerPosition($filePath) {
    if (file_exists($filePath) && filesize($filePath) > 0) {
        $json = file_get_contents($filePath);
        return json_decode($json, true);
    }
    return ['x' => 1, 'y' => 1]; // Posición inicial por defecto
}

/**
 * Guarda la posición actual del jugador.
 * @param string $filePath Ruta al archivo JSON de guardado.
 * @param array $position La posición del jugador (x, y).
 */
function savePlayerPosition($filePath, $position) {
    file_put_contents($filePath, json_encode($position, JSON_PRETTY_PRINT));
}

// --- Lógica de Inicialización ---
$mapData = loadMap($mapFile);

// Cargar o inicializar la posición del jugador
if (!isset($_SESSION['player_pos']) || isset($_GET['reset'])) {
    $_SESSION['player_pos'] = loadPlayerPosition($saveFile);
}

// Guardar la posición actual del jugador en cada carga de página
// (Esto es simple, en un juego real se guardaría en puntos específicos)
savePlayerPosition($saveFile, $_SESSION['player_pos']);

$playerX = $_SESSION['player_pos']['x'];
$playerY = $_SESSION['player_pos']['y'];

// PHP pasa los datos del mapa y del jugador a JavaScript
$jsMapData = json_encode($mapData);
$jsPlayerX = $playerX;
$jsPlayerY = $playerY;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Azul Demo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="game-container">
        <div id="game-map">
            </div>
        <div id="player" style="left: <?php echo $playerX * TILE_SIZE; ?>px; top: <?php echo $playerY * TILE_SIZE; ?>px;"></div>
    </div>

    <div class="controls">
        <button id="up">Arriba</button>
        <button id="down">Abajo</button>
        <button id="left">Izquierda</button>
        <button id="right">Derecha</button>
        <a href="?reset=true" class="reset-button">Reiniciar Posición</a>
    </div>

    <script>
        const TILE_SIZE = <?php echo TILE_SIZE; ?>;
        const MAP_WIDTH_TILES = <?php echo MAP_WIDTH_TILES; ?>;
        const MAP_HEIGHT_TILES = <?php echo MAP_HEIGHT_TILES; ?>;
        const mapData = <?php echo $jsMapData; ?>;

        let playerX = <?php echo $jsPlayerX; ?>;
        let playerY = <?php echo $jsPlayerY; ?>;

        const gameMap = document.getElementById('game-map');
        const player = document.getElementById('player');

        // --- Función para dibujar el mapa ---
        function drawMap() {
            gameMap.style.width = `${MAP_WIDTH_TILES * TILE_SIZE}px`;
            gameMap.style.height = `${MAP_HEIGHT_TILES * TILE_SIZE}px`;
            gameMap.innerHTML = ''; // Limpiar mapa existente

            for (let y = 0; y < MAP_HEIGHT_TILES; y++) {
                for (let x = 0; x < MAP_WIDTH_TILES; x++) {
                    const tile = document.createElement('div');
                    tile.classList.add('tile');
                    // Añadir clase específica para el tipo de tile (grass, tree, path)
                    tile.classList.add(mapData[y][x]);
                    tile.style.left = `${x * TILE_SIZE}px`;
                    tile.style.top = `${y * TILE_SIZE}px`;
                    gameMap.appendChild(tile);
                }
            }
        }

        // --- Función para actualizar la posición visual del jugador ---
        function updatePlayerPosition() {
            player.style.left = `${playerX * TILE_SIZE}px`;
            player.style.top = `${playerY * TILE_SIZE}px`;
        }

        // --- Función para mover al jugador ---
        function movePlayer(dx, dy) {
            const newPlayerX = playerX + dx;
            const newPlayerY = playerY + dy;

            // Comprobar límites del mapa
            if (newPlayerX >= 0 && newPlayerX < MAP_WIDTH_TILES &&
                newPlayerY >= 0 && newPlayerY < MAP_HEIGHT_TILES) {

                // Comprobar colisiones con tiles "bloqueantes" (ej. árboles)
                const targetTileType = mapData[newPlayerY][newPlayerX];
                if (targetTileType !== 'tree') { // Puedes añadir más tipos bloqueantes aquí
                    playerX = newPlayerX;
                    playerY = newPlayerY;
                    updatePlayerPosition();

                    // Enviar la nueva posición al servidor para guardar
                    // Esto es una simplificación; en un juego real, se haría menos frecuentemente
                    // o se acumularían cambios y se enviarían en lotes.
                    fetch(`index.php?x=${playerX}&y=${playerY}`, { method: 'GET' })
                        .then(response => {
                            // console.log('Posición guardada en el servidor.');
                            // No es necesario hacer nada aquí, solo confirmar que la solicitud fue enviada
                        })
                        .catch(error => console.error('Error al guardar posición:', error));
                } else {
                    console.log('¡No puedes pasar por el árbol!');
                }
            }
        }

        // --- Manejadores de Eventos (Teclado y Botones) ---
        document.addEventListener('keydown', (event) => {
            switch (event.key) {
                case 'ArrowUp':
                case 'w':
                    movePlayer(0, -1);
                    break;
                case 'ArrowDown':
                case 's':
                    movePlayer(0, 1);
                    break;
                case 'ArrowLeft':
                case 'a':
                    movePlayer(-1, 0);
                    break;
                case 'ArrowRight':
                case 'd':
                    movePlayer(1, 0);
                    break;
            }
        });

        document.getElementById('up').addEventListener('click', () => movePlayer(0, -1));
        document.getElementById('down').addEventListener('click', () => movePlayer(0, 1));
        document.getElementById('left').addEventListener('click', () => movePlayer(-1, 0));
        document.getElementById('right').addEventListener('click', () => movePlayer(1, 0));

        // --- Inicializar el juego al cargar la página ---
        drawMap();
        updatePlayerPosition(); // Asegurarse de que el jugador esté en la posición inicial
    </script>
</body>
</html>