<?php
session_start();

class SlotMachine {
    private $reels = [
        ['🍒', '🍋', '🍊', '🍇', '🍉', '🔔', '7', '★'],
        ['🍒', '🍋', '🍊', '🍇', '🍉', '🔔', '7', '★'],
        ['🍒', '🍋', '🍊', '🍇', '🍉', '🔔', '7', '★']
    ];
    
    private $playerBalance = 10000;
    private $currentBet = 10;
    private $payouts = [
        '7,7,7' => 500,
        '★,★,★' => 200,
        '🔔,🔔,🔔' => 100,
        '🍇,🍇,🍇' => 50,
        '🍉,🍉,🍉' => 30,
        '🍊,🍊,🍊' => 20,
        '🍋,🍋,🍋' => 15,
        '🍒,🍒,🍒' => 10,
        '🍒,🍒' => 5,
        '🍒' => 2
    ];
    
    public function __construct(int $initialBalance = 100, int $defaultBet = 10) {
        $this->playerBalance = max(0, $initialBalance);
        $this->currentBet = max(1, min($defaultBet, $initialBalance));
    }
    
    public function setBet(int $bet): bool {
        if ($bet > 0 && $bet <= $this->playerBalance) {
            $this->currentBet = $bet;
            return true;
        }
        return false;
    }
    
    public function spin(): array {
        if ($this->currentBet > $this->playerBalance) {
            return [
                'success' => false,
                'message' => 'Saldo insuficiente para esta apuesta'
            ];
        }
        
        $this->playerBalance -= $this->currentBet;
        
        $result = [
            $this->reels[0][array_rand($this->reels[0])],
            $this->reels[1][array_rand($this->reels[1])],
            $this->reels[2][array_rand($this->reels[2])]
        ];
        
        $winAmount = $this->calculateWin($result);
        $this->playerBalance += $winAmount;
        
        return [
            'success' => true,
            'result' => $result,
            'winAmount' => $winAmount,
            'newBalance' => $this->playerBalance,
            'isJackpot' => ($winAmount >= $this->payouts['7,7,7'] * $this->currentBet / 10)
        ];
    }
    
    private function calculateWin(array $result): int {
        $resultString = implode(',', $result);
        
        foreach ($this->payouts as $pattern => $multiplier) {
            $patternParts = explode(',', $pattern);
            
            // Para patrones de 3 símbolos
            if (count($patternParts) === 3) {
                if ($result[0] === $patternParts[0] && 
                    $result[1] === $patternParts[1] && 
                    $result[2] === $patternParts[2]) {
                    return $multiplier * ($this->currentBet / 10);
                }
            }
            // Para patrones de 2 símbolos (primeros dos)
            elseif (count($patternParts) === 2) {
                if ($result[0] === $patternParts[0] && 
                    $result[1] === $patternParts[1]) {
                    return $multiplier * ($this->currentBet / 10);
                }
            }
            // Para patrones de 1 símbolo (primer rodillo)
            elseif (count($patternParts) === 1) {
                if ($result[0] === $patternParts[0]) {
                    return $multiplier * ($this->currentBet / 10);
                }
            }
        }
        
        return 0;
    }
    
    public function getGameInfo(): array {
        return [
            'balance' => $this->playerBalance,
            'currentBet' => $this->currentBet,
            'payouts' => $this->payouts
        ];
    }
    
    public function resetGame(): void {
        $this->playerBalance = 100;
        $this->currentBet = 10;
    }
    
    public function getBalance(): int {
        return $this->playerBalance;
    }
    
    public function getCurrentBet(): int {
        return $this->currentBet;
    }
}

// Inicializar juego en sesión
if (!isset($_SESSION['slot_machine'])) {
    $_SESSION['slot_machine'] = serialize(new SlotMachine());
}

$slotMachine = unserialize($_SESSION['slot_machine']);
$message = '';
$lastResult = null;

// Procesar acciones
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'spin':
                $lastResult = $slotMachine->spin();
                if ($lastResult['success']) {
                    if ($lastResult['winAmount'] > 0) {
                        $message = "¡Ganaste " . $lastResult['winAmount'] . " monedas!";
                        if ($lastResult['isJackpot']) {
                            $message .= " ¡JACKPOT! 🎉";
                        }
                    } else {
                        $message = "Sin suerte esta vez. ¡Sigue intentando!";
                    }
                } else {
                    $message = $lastResult['message'];
                }
                break;
                
            case 'set_bet':
                if (isset($_POST['bet'])) {
                    $bet = (int)$_POST['bet'];
                    if ($slotMachine->setBet($bet)) {
                        $message = "Apuesta establecida en " . $bet . " monedas";
                    } else {
                        $message = "Apuesta inválida";
                    }
                }
                break;
                
            case 'reset':
                $slotMachine->resetGame();
                $message = "Juego reiniciado";
                break;
        }
    }
}

// Guardar estado en sesión
$_SESSION['slot_machine'] = serialize($slotMachine);
$gameInfo = $slotMachine->getGameInfo();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎰 Tragaperras Casino</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .casino-container {
            background: #2c3e50;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            max-width: 500px;
            width: 100%;
            text-align: center;
            border: 4px solid #f39c12;
        }
        
        .casino-title {
            color: #f39c12;
            font-size: 2.5em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .slot-machine {
            background: #34495e;
            border-radius: 15px;
            padding: 20px;
            margin: 20px 0;
            border: 3px solid #e74c3c;
        }
        
        .reels {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            background: #1a252f;
            border-radius: 10px;
            padding: 20px;
        }
        
        .reel {
            background: white;
            border-radius: 10px;
            padding: 20px;
            font-size: 3em;
            min-width: 80px;
            border: 2px solid #3498db;
            animation: spin 0.5s ease-in-out;
        }
        
        @keyframes spin {
            0% { transform: rotateY(0deg); }
            50% { transform: rotateY(180deg); }
            100% { transform: rotateY(360deg); }
        }
        
        .game-info {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            background: #1a252f;
            border-radius: 10px;
            padding: 15px;
        }
        
        .info-item {
            color: #ecf0f1;
            text-align: center;
        }
        
        .info-label {
            font-size: 0.9em;
            color: #bdc3c7;
        }
        
        .info-value {
            font-size: 1.5em;
            font-weight: bold;
            color: #f39c12;
        }
        
        .controls {
            margin: 20px 0;
        }
        
        .bet-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 15px 0;
        }
        
        .bet-input {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            width: 100px;
            text-align: center;
        }
        
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
        }
        
        .btn-spin {
            background: #e74c3c;
            color: white;
            font-size: 1.2em;
            padding: 15px 30px;
            margin: 10px;
        }
        
        .btn-spin:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        .btn-bet {
            background: #3498db;
            color: white;
        }
        
        .btn-bet:hover {
            background: #2980b9;
        }
        
        .btn-reset {
            background: #95a5a6;
            color: white;
        }
        
        .btn-reset:hover {
            background: #7f8c8d;
        }
        
        .message {
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            font-weight: bold;
            min-height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .message.success {
            background: #27ae60;
            color: white;
        }
        
        .message.error {
            background: #e74c3c;
            color: white;
        }
        
        .message.info {
            background: #3498db;
            color: white;
        }
        
        .payout-table {
            background: #1a252f;
            border-radius: 10px;
            padding: 15px;
            margin: 20px 0;
            color: #ecf0f1;
        }
        
        .payout-title {
            color: #f39c12;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        .payout-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px solid #34495e;
        }
        
        .quick-bets {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
        }
        
        .btn-quick-bet {
            background: #9b59b6;
            color: white;
            padding: 8px 15px;
            font-size: 0.9em;
        }
        
        .btn-quick-bet:hover {
            background: #8e44ad;
        }
    </style>
</head>
<body>
    <div class="casino-container">
        <h1 class="casino-title">🎰 CASINO ROYAL</h1>
        
        <div class="slot-machine">
            <div class="reels">
                <?php if ($lastResult && $lastResult['success']): ?>
                    <?php foreach ($lastResult['result'] as $symbol): ?>
                        <div class="reel"><?= $symbol ?></div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="reel">🎰</div>
                    <div class="reel">🎰</div>
                    <div class="reel">🎰</div>
                <?php endif; ?>
            </div>
            
            <div class="game-info">
                <div class="info-item">
                    <div class="info-label">Saldo</div>
                    <div class="info-value"><?= $gameInfo['balance'] ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Apuesta</div>
                    <div class="info-value"><?= $gameInfo['currentBet'] ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Ganancia</div>
                    <div class="info-value"><?= $lastResult && $lastResult['success'] ? $lastResult['winAmount'] : 0 ?></div>
                </div>
            </div>
        </div>
        
        <?php if ($message): ?>
            <div class="message <?= strpos($message, 'Ganaste') !== false || strpos($message, 'JACKPOT') !== false ? 'success' : (strpos($message, 'insuficiente') !== false ? 'error' : 'info') ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <div class="controls">
            <form method="POST" style="display: inline;">
                <button type="submit" name="action" value="spin" class="btn btn-spin" 
                        <?= $gameInfo['balance'] < $gameInfo['currentBet'] ? 'disabled' : '' ?>>
                    🎰 GIRAR
                </button>
            </form>
            
            <div class="bet-controls">
                <form method="POST" style="display: flex; align-items: center; gap: 10px;">
                    <label for="bet" style="color: #ecf0f1;">Apuesta:</label>
                    <input type="number" name="bet" id="bet" class="bet-input" 
                           value="<?= $gameInfo['currentBet'] ?>" min="1" max="<?= $gameInfo['balance'] ?>">
                    <button type="submit" name="action" value="set_bet" class="btn btn-bet">
                        Establecer
                    </button>
                </form>
            </div>
            
            <div class="quick-bets">
                <form method="POST" style="display: inline;">
                    <button type="submit" name="action" value="set_bet" class="btn btn-quick-bet">
                        <input type="hidden" name="bet" value="5">
                        5 💰
                    </button>
                </form>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="action" value="set_bet" class="btn btn-quick-bet">
                        <input type="hidden" name="bet" value="10">
                        10 💰
                    </button>
                </form>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="action" value="set_bet" class="btn btn-quick-bet">
                        <input type="hidden" name="bet" value="25">
                        25 💰
                    </button>
                </form>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="action" value="set_bet" class="btn btn-quick-bet">
                        <input type="hidden" name="bet" value="50">
                        50 💰
                    </button>
                </form>
            </div>
            
            <form method="POST" style="display: inline;">
                <button type="submit" name="action" value="reset" class="btn btn-reset">
                    🔄 Reiniciar Juego
                </button>
            </form>
        </div>
        
        <div class="payout-table">
            <div class="payout-title">💰 Tabla de Premios</div>
            <?php foreach ($gameInfo['payouts'] as $combination => $payout): ?>
                <div class="payout-row">
                    <span><?= str_replace(',', ' ', $combination) ?></span>
                    <span><?= $payout ?>x</span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>