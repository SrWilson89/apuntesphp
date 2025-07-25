<?php

// Anotación: Es buena práctica incluir la clase Pregunta si TestManager va a interactuar con ella.
require_once 'pregunta.php';

class TestManager {
    private $filename = "partidas.txt"; // Archivo donde se guardarán los resultados de las partidas.
    private $cookie_name = "test_progress"; // Nombre de la cookie para el progreso del test.

    /**
     * Guarda el estado actual de un test en una cookie.
     * Esto permite recuperar el test si se queda a medias.
     * @param array $test_data Datos del test a guardar (ej: pregunta_actual, respuestas_usuario, tiempo_inicio).
     * Anotación: Las cookies tienen un límite de tamaño (aprox. 4KB). Para tests muy largos o datos complejos,
     * se debería considerar almacenar en el servidor (sesiones de PHP, base de datos) y solo guardar un ID de sesión en la cookie.
     */
    public function saveTestProgress(array $test_data) {
        // Anotación: `json_encode` convierte el array PHP a una cadena JSON para guardarla en la cookie.
        $encoded_data = json_encode($test_data);
        // Anotación: `setcookie()` establece una cookie.
        // El último parámetro es `httponly` (true): La cookie solo es accesible a través de HTTP/S, no por JavaScript,
        // lo que ayuda a prevenir ataques XSS.
        // `time() + (86400 * 30)` establece la cookie para que expire en 30 días (86400 segundos = 1 día).
        setcookie($this->cookie_name, $encoded_data, [
            'expires' => time() + (86400 * 30), // 30 días de duración
            'path' => '/', // Disponible en todo el dominio
            'secure' => true, // Solo se envía sobre HTTPS (en producción, siempre true)
            'httponly' => true, // No accesible vía JavaScript
            'samesite' => 'Lax' // Protege contra CSRF, 'Lax' es un buen balance.
        ]);
    }

    /**
     * Recupera el estado de un test desde una cookie.
     * @return array|null Los datos del test si existen, o null si no hay progreso guardado.
     */
    public function getTestProgress() {
        if (isset($_COOKIE[$this->cookie_name])) {
            // Anotación: `json_decode` convierte la cadena JSON de la cookie de vuelta a un array PHP.
            // `true` como segundo argumento hace que decodifique como array asociativo.
            return json_decode($_COOKIE[$this->cookie_name], true);
        }
        return null;
    }

    /**
     * Elimina el progreso del test de la cookie.
     */
    public function clearTestProgress() {
        // Anotación: Para eliminar una cookie, se establece su fecha de expiración en el pasado.
        setcookie($this->cookie_name, "", [
            'expires' => time() - 3600, // Expira hace una hora
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }

    /**
     * Guarda el resultado de una partida finalizada en el archivo de texto.
     * @param string $player_name Nombre del jugador.
     * @param int $correct_answers Número de respuestas correctas.
     * @param float $percentage Porcentaje de aciertos.
     * @param int $time_taken_seconds Tiempo total en segundos.
     * @return bool True si se guardó correctamente, false en caso contrario.
     */
    public function saveGameResult(string $player_name, int $correct_answers, float $percentage, int $time_taken_seconds) {
        $result = [
            'player_name' => $player_name,
            'correct_answers' => $correct_answers,
            'percentage' => $percentage,
            'time_taken_seconds' => $time_taken_seconds,
            'date' => date('Y-m-d H:i:s') // Anotación: Guardar la fecha y hora es útil.
        ];

        $myfile = fopen($this->filename, "a");
        if (!$myfile) {
            error_log("Error: No se pudo abrir el archivo " . $this->filename . " para guardar resultados.");
            return false;
        }

        fwrite($myfile, json_encode($result) . "\n");
        fclose($myfile);
        return true;
    }

    /**
     * Obtiene todas las partidas guardadas.
     * @return array Un array de arrays asociativos con los resultados de las partidas.
     */
    public function getAllGameResults(): array {
        $results = [];
        if (!file_exists($this->filename) || filesize($this->filename) === 0) {
            return $results;
        }

        $lines = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // Anotación: file() es práctico para leer líneas de un archivo.

        foreach ($lines as $line) {
            $data = json_decode($line, true); // Decodificar como array asociativo.
            if ($data !== null) {
                $results[] = $data;
            } else {
                error_log("Error al decodificar resultado de partida en línea: " . $line);
            }
        }
        return $results;
    }

    /**
     * Limpia el archivo de resultados de partidas.
     * Anotación: ¡Usar con precaución! Borrará todos los datos.
     * @return bool True si se limpió correctamente, false en caso contrario.
     */
    public function clearGameResults(): bool {
        // Anotación: `file_put_contents` con una cadena vacía es una forma sencilla de vaciar un archivo.
        if (file_put_contents($this->filename, "") === false) {
            error_log("Error: No se pudo limpiar el archivo de resultados " . $this->filename);
            return false;
        }
        return true;
    }
}

?>