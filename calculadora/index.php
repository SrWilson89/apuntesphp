<?php
session_start();

// Clase para manejar el estado de la calculadora
class CalculatorState {
    public $display = '0';
    public $operation = '';
    public $first_number = '';
    public $last_result = '0'; // Store the last result after '='
    public $waiting_for_number = false;
    public $error = false;
    public $expression = []; // Store tokens for current operation
    
    public function reset() {
        $this->display = '0';
        $this->operation = '';
        $this->first_number = '';
        $this->last_result = '0';
        $this->waiting_for_number = false;
        $this->error = false;
        $this->expression = [];
    }
    
    public function clearEntry() {
        $this->display = '0';
        $this->error = false;
        $this->expression = [];
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
    } elseif (in_array($input, ['+', '-', '*', '/'])) {
        handleOperation($input, $state);
    } elseif ($input == '=') {
        handleEquals($state);
    } elseif ($input == '.') {
        handleDecimalPoint($state);
    } elseif (is_numeric($input)) {
        handleNumberInput($input, $state);
    }
}

// Funciones auxiliares
function handleOperation($op, CalculatorState $state) {
    if ($state->error) return;
    
    if ($state->display != '0') {
        $state->first_number = $state->display;
    } elseif ($state->last_result != '0') {
        $state->first_number = $state->last_result;
    }
    
    $state->operation = $op;
    $state->display = '0';
    $state->waiting_for_number = true;
}

function handleEquals(CalculatorState $state) {
    if ($state->error || $state->operation == '') return;
    
    $second_number = $state->display != '0' ? $state->display : '0';
    $result = calculate((float)$state->first_number, (float)$second_number, $state->operation);
    if ($result === false) {
        $state->display = 'Error';
        $state->error = true;
        return;
    }
    
    $state->display = formatResult($result);
    $state->last_result = $state->display; // Save the result
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
        default: return false;
    }
}

function formatResult($result) {
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
    <title>Calculadora</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6b5b95, #a17fff);
            font-family: Arial, sans-serif;
        }
        .calculator {
            background: #4a4063;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        .display {
            background: #2d2a3a;
            color: white;
            font-size: 2.5em;
            text-align: right;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        button {
            padding: 20px;
            font-size: 1.2em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            background: #ffffff;
            color: #2d2a3a;
            transition: background 0.3s, transform 0.1s;
        }
        button:hover {
            background: #e0e0e0;
            transform: scale(1.05);
        }
        button:active {
            transform: scale(0.95);
        }
        .clear {
            background: #ff6b6b;
            color: white;
        }
        .clear:hover {
            background: #ff8787;
        }
        .operator {
            background: #6b5b95;
            color: white;
        }
        .operator:hover {
            background: #8a7ab7;
        }
        .equals {
            background: #4CAF50;
            color: white;
        }
        .equals:hover {
            background: #66BB6A;
        }
        .zero {
            grid-column: span 2;
        }
        h1 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1>Calculadora</h1>
        <div class="display">
            <?php echo htmlspecialchars($state->display); ?>
        </div>
        <form method="post" class="buttons">
            <button type="submit" name="input" value="C" class="clear">C</button>
            <button type="submit" name="input" value="(" class="operator">(</button>
            <button type="submit" name="input" value=")" class="operator">)</button>
            <button type="submit" name="input" value="+" class="operator">+</button>
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
            <button type="submit" name="input" value="/" class="operator">÷</button>
            <button type="submit" name="input" value="0" class="zero">0</button>
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
</body>
</html>