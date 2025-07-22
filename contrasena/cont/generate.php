<?php
/**
 * Generador de Contraseñas Seguras
 * Versión: 2.1
 * Funcionalidades: Generación segura, validaciones y análisis de fuerza
 */

class PasswordGenerator {
    
    private $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    private $numbers = '0123456789';
    private $symbols = '!@#$%^&*()_+-=[]{}|;:,.<>?'; // Caracteres especiales seguros

    /**
     * Genera una contraseña segura basada en los parámetros dados
     * @param int $length Longitud de la contraseña
     * @param array $options Opciones de caracteres a incluir (uppercase, lowercase, numbers, symbols)
     * @return string|false Contraseña generada o false en caso de error
     */
    public function generate($length, $options) {
        // Validar longitud
        if ($length < 4 || $length > 128) {
            return false;
        }
        
        $characters = '';
        $requiredChars = [];
        
        // Construir conjunto de caracteres y caracteres requeridos
        if ($options['uppercase']) {
            $characters .= $this->uppercase;
            // Asegurar que haya al menos un carácter de cada tipo seleccionado
            $requiredChars[] = $this->uppercase[random_int(0, strlen($this->uppercase) - 1)];
        }
        
        if ($options['lowercase']) {
            $characters .= $this->lowercase;
            $requiredChars[] = $this->lowercase[random_int(0, strlen($this->lowercase) - 1)];
        }
        
        if ($options['numbers']) {
            $characters .= $this->numbers;
            $requiredChars[] = $this->numbers[random_int(0, strlen($this->numbers) - 1)];
        }
        
        if ($options['symbols']) {
            $characters .= $this->symbols;
            $requiredChars[] = $this->symbols[random_int(0, strlen($this->symbols) - 1)];
        }
        
        // Verificar que hay caracteres disponibles (al menos una opción seleccionada)
        if (empty($characters)) {
            return false;
        }
        
        $password = '';
        $charactersLength = strlen($characters);
        
        // Rellenar la contraseña con caracteres aleatorios, incluyendo los requeridos
        // Primero, insertar los caracteres requeridos en posiciones aleatorias
        shuffle($requiredChars); // Mezcla los caracteres requeridos para que no estén siempre al principio
        
        for ($i = 0; $i < $length; $i++) {
            if (isset($requiredChars[$i])) {
                $password .= $requiredChars[$i];
            } else {
                $password .= $characters[random_int(0, $charactersLength - 1)];
            }
        }
        
        // Asegurarse de que todos los caracteres requeridos fueron insertados
        // y mezclar el resto de la contraseña para mayor aleatoriedad
        // La implementación anterior podía sobrescribir caracteres requeridos
        // Es mejor generar la contraseña y luego insertar los requeridos, y finalmente mezclar.
        $generatedPasswordChars = [];
        for ($i = 0; $i < $length; $i++) {
            $generatedPasswordChars[] = $characters[random_int(0, $charactersLength - 1)];
        }

        // Insertar los caracteres requeridos en posiciones aleatorias de la contraseña generada
        $tempPasswordArray = $generatedPasswordChars;
        $numRequired = count($requiredChars);

        if ($numRequired > 0) {
            // Asegúrate de que $length sea mayor o igual que $numRequired para evitar errores
            // Esto ya se valida al inicio con $length < 4 o si no hay opciones seleccionadas.
            if ($length < $numRequired) {
                // Esto no debería ocurrir si las validaciones iniciales son correctas
                // y se ha seleccionado al menos una opción para generar
                return false; 
            }

            $positions = range(0, $length - 1);
            shuffle($positions); // Mezclar posiciones para insertar

            for ($i = 0; $i < $numRequired; $i++) {
                $tempPasswordArray[$positions[$i]] = $requiredChars[$i];
            }
        }
        
        // Mezclar la contraseña final para mayor aleatoriedad
        return $this->shuffleString(implode('', $tempPasswordArray));
    }
    
    /**
     * Mezcla los caracteres de una cadena
     * @param string $string Cadena a mezclar
     * @return string Cadena mezclada
     */
    private function shuffleString($string) {
        $array = str_split($string);
        
        // Algoritmo Fisher-Yates para mezclar
        for ($i = count($array) - 1; $i > 0; $i--) {
            $j = random_int(0, $i);
            // Intercambio
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
        }
        
        return implode('', $array);
    }
    
    /**
     * Evalúa la fuerza de una contraseña
     * @param string $password Contraseña a evaluar
     * @return array Información sobre la fuerza de la contraseña
     */
    public function evaluateStrength($password) {
        $score = 0;
        $feedback = [];
        $suggestions = [];
        
        $length = strlen($password);
        
        // Puntuación basada en la longitud
        if ($length < 8) {
            $feedback[] = 'La contraseña es demasiado corta.';
            $suggestions[] = 'Aumenta la longitud a al menos 8 caracteres.';
        } elseif ($length >= 8 && $length < 12) {
            $score += 20;
            $feedback[] = 'Longitud aceptable.';
            $suggestions[] = 'Considera aumentar la longitud para mayor seguridad.';
        } elseif ($length >= 12 && $length < 16) {
            $score += 30;
            $feedback[] = 'Buena longitud.';
        } elseif ($length >= 16) {
            $score += 40;
            $feedback[] = 'Excelente longitud.';
        }

        $hasLower = preg_match('/[a-z]/', $password);
        $hasUpper = preg_match('/[A-Z]/', $password);
        $hasNumber = preg_match('/[0-9]/', $password);
        $hasSymbol = preg_match('/[^A-Za-z0-9]/', $password);

        // Puntuación y feedback basada en tipos de caracteres
        $charTypesCount = 0;
        if ($hasLower) { $score += 10; $charTypesCount++; } else { $suggestions[] = 'Incluye letras minúsculas.'; }
        if ($hasUpper) { $score += 10; $charTypesCount++; } else { $suggestions[] = 'Incluye letras mayúsculas.'; }
        if ($hasNumber) { $score += 15; $charTypesCount++; } else { $suggestions[] = 'Incluye números.'; }
        if ($hasSymbol) { $score += 15; $charTypesCount++; } else { $suggestions[] = 'Incluye símbolos.'; }

        if ($charTypesCount < 3) {
            $feedback[] = 'La contraseña usa pocos tipos de caracteres.';
        } elseif ($charTypesCount == 3) {
            $feedback[] = 'La contraseña usa una buena variedad de caracteres.';
        } elseif ($charTypesCount == 4) {
            $feedback[] = 'La contraseña usa una excelente variedad de caracteres.';
        }

        // Puntuación adicional por complejidad
        if ($hasLower && $hasUpper) $score += 5;
        if (($hasNumber && $hasSymbol) || ($hasLower && $hasNumber && $hasSymbol) || ($hasUpper && $hasNumber && $hasSymbol)) $score += 5;

        // Verificar patrones comunes (ej. repeticiones, secuencias)
        if (preg_match('/(.)\1{2,}/', $password)) { // 3 o más caracteres repetidos
            $score -= 20;
            $feedback[] = 'Evita la repetición de caracteres.';
            $suggestions[] = 'Evita secuencias o repeticiones (ej. "aaa", "111").';
        }
        if (preg_match('/(abc|123|qwe|asd)/i', $password)) { // Secuencias comunes
             $score -= 10;
             $feedback[] = 'Contiene secuencias comunes.';
             $suggestions[] = 'Evita secuencias obvias (ej. "abc", "123").';
        }
        
        // Ajustar el score para que no exceda 100 ni sea negativo
        $score = max(0, min($score, 100));

        $strengthText = '';
        if ($score < 40) {
            $strengthText = 'Muy Débil';
        } elseif ($score < 60) {
            $strengthText = 'Débil';
        } elseif ($score < 80) {
            $strengthText = 'Buena';
        } elseif ($score < 95) {
            $strengthText = 'Fuerte';
        } else {
            $strengthText = 'Muy Fuerte';
        }
        
        return [
            'score' => $score,
            'strength_text' => $strengthText,
            'length' => $length,
            'hasLower' => $hasLower,
            'hasUpper' => $hasUpper,
            'hasNumber' => $hasNumber,
            'hasSymbol' => $hasSymbol,
            'feedback' => $feedback,
            'suggestions' => $suggestions
        ];
    }

    /**
     * Calcula la entropía de una contraseña
     * @param string $password Contraseña a analizar
     * @return float Entropía en bits
     */
    public function calculateEntropy($password) {
        if (empty($password)) {
            return 0.0;
        }

        $charsetSize = 0;
        
        // Determine el tamaño del conjunto de caracteres usado en la contraseña
        // Una forma más precisa sería iterar sobre la contraseña y ver qué caracteres usa.
        // Pero para una estimación, podemos considerar el tamaño total de los conjuntos si se usaron.
        
        // Contar tipos de caracteres presentes en la contraseña
        $hasLower = preg_match('/[a-z]/', $password);
        $hasUpper = preg_match('/[A-Z]/', $password);
        $hasNumber = preg_match('/[0-9]/', $password);
        $hasSymbol = preg_match('/[^A-Za-z0-9]/', $password);

        if ($hasLower) $charsetSize += strlen($this->lowercase);
        if ($hasUpper) $charsetSize += strlen($this->uppercase);
        if ($hasNumber) $charsetSize += strlen($this->numbers);
        if ($hasSymbol) $charsetSize += strlen($this->symbols);

        // Si la contraseña usa caracteres fuera de nuestros conjuntos definidos, esta estimación será inexacta.
        // Para una precisión extrema, habría que construir un conjunto de caracteres único a partir de la contraseña.
        // Sin embargo, para contraseñas generadas por esta clase, esto es suficiente.
        if ($charsetSize === 0) { // En caso de que la contraseña esté vacía o no coincida con los charsets
            return 0.0;
        }
        
        $length = strlen($password);
        
        // Entropía = log2(charsetSize^length) = length * log2(charsetSize)
        // log2(x) = log(x) / log(2)
        $entropy = $length * (log($charsetSize) / log(2));
        
        return round($entropy, 2);
    }
}

// --- Procesar solicitud ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        $generator = new PasswordGenerator();
        
        // Obtener y validar parámetros
        $length = isset($_POST['length']) ? intval($_POST['length']) : 12;
        
        // Validar rango de longitud
        if ($length < 4 || $length > 128) {
            throw new Exception("La longitud debe estar entre 4 y 128 caracteres.");
        }
        
        // Obtener opciones de caracteres
        $options = [
            'uppercase' => isset($_POST['uppercase']),
            'lowercase' => isset($_POST['lowercase']),
            'numbers' => isset($_POST['numbers']),
            'symbols' => isset($_POST['symbols'])
        ];
        
        // Validar que al menos una opción esté seleccionada
        if (!array_filter($options)) {
            throw new Exception("Debes seleccionar al menos un tipo de carácter.");
        }
        
        // Generar contraseña
        $password = $generator->generate($length, $options);
        
        if ($password === false) {
            throw new Exception("Error interno al generar la contraseña. Asegúrate de que la longitud sea suficiente para los tipos de caracteres seleccionados.");
        }
        
        // Evaluar fuerza y calcular entropía
        $strength = $generator->evaluateStrength($password);
        $entropy = $generator->calculateEntropy($password);

        // --- Preparar datos para respuesta ---
        $response_data = [
            'success' => true,
            'password' => $password,
            'strength' => $strength['strength_text'],
            'score' => $strength['score'],
            'length' => $strength['length'],
            'hasLower' => $strength['hasLower'],
            'hasUpper' => $strength['hasUpper'],
            'hasNumber' => $strength['hasNumber'],
            'hasSymbol' => $strength['hasSymbol'],
            'feedback' => $strength['feedback'],
            'suggestions' => $strength['suggestions'],
            'entropy' => $entropy
        ];

        // Decidir si redirigir o devolver JSON
        // Esto permite que el mismo script sea usado por un formulario tradicional o una llamada AJAX
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            // Es una solicitud AJAX, devolver JSON
            header('Content-Type: application/json');
            echo json_encode($response_data);
        } else {
            // Es una solicitud de formulario normal, redirigir
            $redirectUrl = 'index.html?password=' . urlencode($password);
            $redirectUrl .= '&strength=' . urlencode($strength['strength_text']);
            $redirectUrl .= '&score=' . $strength['score'];
            $redirectUrl .= '&entropy=' . $entropy;
            
            // Puedes añadir más parámetros si quieres mostrar más detalles en la URL
            // (aunque para URLs muy largas es mejor usar AJAX o sesiones)
            
            header("Location: " . $redirectUrl);
        }
        exit();
        
    } catch (Exception $e) {
        // Manejar errores
        $errorMessage = $e->getMessage();
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            // Si es AJAX, devolver JSON de error
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => $errorMessage]);
        } else {
            // Si es formulario normal, redirigir con error
            header("Location: index.html?error=" . urlencode($errorMessage));
        }
        exit();
    }
    
} else {
    // Si se accede directamente al archivo PHP sin POST, redirigir
    header("Location: index.html");
    exit();
}

// --- Funciones auxiliares para uso futuro (dentro de la clase si manejan propiedades de la clase) ---

/**
 * Genera múltiples contraseñas
 * NOTA: Esta función no está dentro de la clase PasswordGenerator.
 * Si quieres usar las propiedades de la clase (e.g., $this->uppercase),
 * debería ser un método estático o de instancia de la clase, o recibir una instancia.
 * Por simplicidad, la dejaremos fuera asumiendo que crea una nueva instancia.
 * @param int $count Número de contraseñas a generar
 * @param int $length Longitud de cada contraseña
 * @param array $options Opciones de caracteres
 * @return array Array de contraseñas generadas
 */
function generateMultiple($count, $length, $options) {
    $generator = new PasswordGenerator(); // Crea una nueva instancia por cada llamada
    $passwords = [];
    
    for ($i = 0; $i < $count; $i++) {
        $password = $generator->generate($length, $options);
        if ($password !== false) {
            $passwords[] = $password;
        }
    }
    
    return $passwords;
}

/**
 * Verifica si una contraseña ha sido comprometida (implementación básica)
 * En un entorno real, esto consultaría APIs como HaveIBeenPwned
 * @param string $password Contraseña a verificar
 * @return bool True si la contraseña no está en la lista de comprometidas
 */
function isPasswordSafe($password) {
    // Lista básica de contraseñas comunes (en producción usarías una base de datos grande o una API)
    $commonPasswords = [
        '123456', 'password', '123456789', 'qwerty', 'abc123',
        'monkey', '1234567', 'letmein', 'trustno1', 'dragon',
        'admin', 'iloveyou', 'p@ssword', 'secret'
    ];
    
    return !in_array(strtolower($password), $commonPasswords);
}