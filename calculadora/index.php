<?php
session_start();

// Clase para manejar el estado de la calculadora
class CalculatorState {
    public $display = '0';
    public $operation = '';
    public $first_number = '';
    public $waiting_for_number = false;
    public $error = false;
    
    public function reset() {
        $this->display = '0';
        $this->operation = '';
        $this->first_number = '';
        $this->waiting_for_number = false;
        $this->error = false;
    }
    
    public function clearEntry() {
        $this->display = '0';
        $this->error = false;
    }
}

// Inicializar o recuperar el estado
$state = isset($_SESSION['calculator_state']) ? unserialize($_SESSION['calculator_state']) : new CalculatorState();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = $_POST['input'] ?? '';
    
    // Procesar la entrada
    processInput($input, $state);
}

// Guardar el estado en la sesión
$_SESSION['calculator_state'] = serialize($state);

// Función para procesar la entrada
function processInput($input, CalculatorState $state) {
    if ($input == 'C') {
        $state->reset();
    } elseif ($input == 'CE') {
        $state->clearEntry();
    } elseif (in_array($input, ['+', '-', '*', '/', '%'])) {
        handleOperation($input, $state);
    } elseif ($input == '=') {
        handleEquals($state);
    } elseif ($input == '.') {
        handleDecimalPoint($state);
    } elseif ($input == '+/-') {
        handleSignChange($state);
    } elseif (is_numeric($input)) {
        handleNumberInput($input, $state);
    }
}

// Funciones auxiliares
function handleOperation($op, CalculatorState $state) {
    if ($state->error) return;
    
    if ($state->operation != '' && !$state->waiting_for_number) {
        $result = calculate((float)$state->first_number, (float)$state->display, $state->operation);
        if ($result === false) {
            $state->display = 'Error';
            $state->error = true;
            return;
        }
        $state->display = formatResult($result);
        $state->first_number = $result;
    } else {
        $state->first_number = $state->display;
    }
    
    $state->operation = $op;
    $state->waiting_for_number = true;
}

function handleEquals(CalculatorState $state) {
    if ($state->error || $state->operation == '' || $state->first_number === '') return;
    
    $result = calculate((float)$state->first_number, (float)$state->display, $state->operation);
    if ($result === false) {
        $state->display = 'Error';
        $state->error = true;
        return;
    }
    
    $state->display = formatResult($result);
    $state->operation = '';
    $state->first_number = '';
    $state->waiting_for_number = false;
}

function handleDecimalPoint(CalculatorState $state) {
    if ($state->error) return;
    
    if ($state->waiting_for_number) {
        $state->display = '0.';
        $state->waiting_for_number = false;
    } elseif (strpos($state->display, '.') === false) {
        $state->display .= '.';
    }
}

function handleSignChange(CalculatorState $state) {
    if ($state->error) return;
    
    if ($state->display != '0') {
        $state->display = $state->display[0] == '-' ? 
            substr($state->display, 1) : 
            '-' . $state->display;
    }
}

function handleNumberInput($num, CalculatorState $state) {
    if ($state->error) return;
    
    if ($state->waiting_for_number || $state->display == '0' || $state->display == 'Error') {
        $state->display = $num;
        $state->waiting_for_number = false;
    } else {
        $state->display .= $num;
    }
}

function calculate($num1, $num2, $op) {
    switch ($op) {
        case '+': return $num1 + $num2;
        case '-': return $num1 - $num2;
        case '*': return $num1 * $num2;
        case '/': 
            if ($num2 == 0) return false;
            return $num1 / $num2;
        case '%': return $num1 * ($num2 / 100);
        default: return false;
    }
}

function formatResult($result) {
    // Limitar a 10 decimales y eliminar ceros innecesarios
    $formatted = number_format($result, 10, '.', '');
    $formatted = rtrim($formatted, '0');
    $formatted = rtrim($formatted, '.');
    
    return $formatted !== '' ? $formatted : '0';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP Avanzada</title>
    <style>
        :root {
            --primary-color: #4a6bff;
            --secondary-color: #ff6b6b;
            --accent-color: #00c853;
            --dark-color: #2d3748;
            --light-color: #f8f9fa;
            --shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .calculator {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 100%;
            max-width: 400px;
            overflow: hidden;
        }

        .display-container {
            position: relative;
            margin-bottom: 20px;
        }

        .operation-display {
            position: absolute;
            top: 10px;
            right: 20px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            height: 20px;
        }

        .display {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 25px 20px 20px;
            border-radius: 15px;
            text-align: right;
            font-size: 2.5rem;
            font-weight: 300;
            min-height: 100px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            word-break: break-all;
            overflow: hidden;
            transition: var(--transition);
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 12px;
        }

        button {
            padding: 18px 0;
            font-size: 1.3rem;
            font-weight: 500;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            background: rgba(255, 255, 255, 0.9);
            color: var(--dark-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            user-select: none;
            position: relative;
            overflow: hidden;
        }

        button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 0;
            border-radius: 100%;
            transform: scale(1, 1) translate(-50%, -50%);
            transform-origin: 50% 50%;
        }

        button:active::after {
            animation: ripple 0.6s ease-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(0, 0);
                opacity: 0.5;
            }
            100% {
                transform: scale(20, 20);
                opacity: 0;
            }
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        button:active {
            transform: translateY(0);
        }

        .operator {
            background: linear-gradient(135deg, var(--primary-color), #3a56e8);
            color: white;
        }

        .operator:hover {
            background: linear-gradient(135deg, #3a56e8, #2a46d8);
        }

        .equals {
            background: linear-gradient(135deg, var(--accent-color), #00b14a);
            color: white;
        }

        .equals:hover {
            background: linear-gradient(135deg, #00b14a, #009a40);
        }

        .clear {
            background: linear-gradient(135deg, var(--secondary-color), #e85555);
            color: white;
        }

        .clear:hover {
            background: linear-gradient(135deg, #e85555, #d84545);
        }

        .zero {
            grid-column: span 2;
        }

        .error {
            color: #ff4444;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        h1 {
            text-align: center;
            color: white;
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: 500;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .memory-indicator {
            position: absolute;
            top: 10px;
            left: 20px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        @media (max-width: 400px) {
            .calculator {
                padding: 15px;
            }
            
            button {
                padding: 15px 0;
                font-size: 1.1rem;
            }
            
            .display {
                font-size: 2rem;
                min-height: 80px;
            }
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1>Calculadora Avanzada</h1>
        
        <div class="display-container">
            <div class="operation-display">
                <?php 
                if ($state->operation != '') {
                    echo htmlspecialchars($state->first_number) . ' ' . htmlspecialchars($state->operation);
                }
                ?>
            </div>
            <div class="display <?php echo $state->error ? 'error' : '' ?>">
                <?php echo htmlspecialchars($state->display) ?>
            </div>
        </div>
        
        <form method="post" class="buttons">
            <button type="submit" name="input" value="C" class="clear">C</button>
            <button type="submit" name="input" value="CE" class="clear">CE</button>
            <button type="submit" name="input" value="%" class="operator">%</button>
            <button type="submit" name="input" value="/" class="operator">÷</button>
            
            <button type="submit" name="input" value="7">7</button>
            <button type="submit" name="input" value="8">8</button>
            <button type="submit" name="input" value="9">9</button>
            <button type="submit" name="input" value="*" class="operator">×</button>
            
            <button type="submit" name="input" value="4">4</button>
            <button type="submit" name="input" value="5">5</button>
            <button type="submit" name="input" value="6">6</button>
            <button type="submit" name="input" value="-" class="operator">-</button>
            
            <button type="submit" name="input" value="1">1</button>
            <button type="submit" name="input" value="2">2</button>
            <button type="submit" name="input" value="3">3</button>
            <button type="submit" name="input" value="+" class="operator" style="grid-row: span 2;">+</button>
            
            <button type="submit" name="input" value="+/-">+/-</button>
            <button type="submit" name="input" value="0">0</button>
            <button type="submit" name="input" value=".">.</button>
            
            <button type="submit" name="input" value="=" class="equals">=</button>
        </form>
        <?php
        // En 3raya/index.php, ajedrez/index.php, etc.

        // ... Tu código PHP

        // Incluir el footer.php que está un nivel arriba
        include '../footer.php';

        // O, si quieres asegurarte de que solo se incluya una vez y parar la ejecución si no se encuentra:
        // require_once '../footer.php';
        ?>
    </div>
    
    <script>
        // Mejora la experiencia táctil en dispositivos móviles
        document.addEventListener('touchstart', function() {}, {passive: true});
        
        // Efecto de retroalimentación táctil
        const buttons = document.querySelectorAll('button');
        buttons.forEach(button => {
            button.addEventListener('touchstart', function() {
                this.classList.add('active');
            });
            
            button.addEventListener('touchend', function() {
                this.classList.remove('active');
            });
        });
    </script>
</body>
</html> 