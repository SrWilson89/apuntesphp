<?php
session_start();

// Constantes para tipos de piezas
define('WHITE', 'white');
define('BLACK', 'black');
define('PAWN', 'p');
define('KNIGHT', 'n');
define('BISHOP', 'b');
define('ROOK', 'r');
define('QUEEN', 'q');
define('KING', 'k');

// Función para inicializar el tablero
function initializeBoard() {
    return [
        ['R', 'N', 'B', 'Q', 'K', 'B', 'N', 'R'],
        ['P', 'P', 'P', 'P', 'P', 'P', 'P', 'P'],
        ['', '', '', '', '', '', '', ''],
        ['', '', '', '', '', '', '', ''],
        ['', '', '', '', '', '', '', ''],
        ['', '', '', '', '', '', '', ''],
        ['p', 'p', 'p', 'p', 'p', 'p', 'p', 'p'],
        ['r', 'n', 'b', 'q', 'k', 'b', 'n', 'r']
    ];
}

// Inicializar o reiniciar el juego
if (!isset($_SESSION['chess_board'])) {
    $_SESSION['chess_board'] = initializeBoard();
    $_SESSION['current_player'] = WHITE;
    $_SESSION['message'] = 'Turno de las Blancas';
    $_SESSION['message_type'] = 'info';
    $_SESSION['promotion_pending'] = false;
    $_SESSION['pawn_to_promote_pos'] = null;
    $_SESSION['selected_piece'] = null;
    $_SESSION['possible_moves'] = [];
    $_SESSION['move_history'] = [];
    $_SESSION['white_can_castle_kingside'] = true;
    $_SESSION['white_can_castle_queenside'] = true;
    $_SESSION['black_can_castle_kingside'] = true;
    $_SESSION['black_can_castle_queenside'] = true;
    $_SESSION['en_passant_target'] = null;
    $_SESSION['halfmove_clock'] = 0;
    $_SESSION['fullmove_number'] = 1;
    $_SESSION['king_positions'] = [
        WHITE => [7, 4],
        BLACK => [0, 4]
    ];
}

// Manejar reinicio del juego
if (isset($_GET['reset'])) {
    $_SESSION['chess_board'] = initializeBoard();
    $_SESSION['current_player'] = WHITE;
    $_SESSION['message'] = 'Juego reiniciado. Turno de las Blancas';
    $_SESSION['message_type'] = 'info';
    $_SESSION['promotion_pending'] = false;
    $_SESSION['pawn_to_promote_pos'] = null;
    $_SESSION['selected_piece'] = null;
    $_SESSION['possible_moves'] = [];
    $_SESSION['move_history'] = [];
    $_SESSION['white_can_castle_kingside'] = true;
    $_SESSION['white_can_castle_queenside'] = true;
    $_SESSION['black_can_castle_kingside'] = true;
    $_SESSION['black_can_castle_queenside'] = true;
    $_SESSION['en_passant_target'] = null;
    $_SESSION['halfmove_clock'] = 0;
    $_SESSION['fullmove_number'] = 1;
    $_SESSION['king_positions'] = [
        WHITE => [7, 4],
        BLACK => [0, 4]
    ];
}

// Acceso a variables de sesión
$board = $_SESSION['chess_board'];
$current_player = $_SESSION['current_player'];
$message = $_SESSION['message'];
$message_type = $_SESSION['message_type'];
$promotion_pending = $_SESSION['promotion_pending'];
$pawn_to_promote_pos = $_SESSION['pawn_to_promote_pos'];
$selected_piece = $_SESSION['selected_piece'];
$possible_moves = $_SESSION['possible_moves'];
$move_history = $_SESSION['move_history'];
$white_can_castle_kingside = $_SESSION['white_can_castle_kingside'];
$white_can_castle_queenside = $_SESSION['white_can_castle_queenside'];
$black_can_castle_kingside = $_SESSION['black_can_castle_kingside'];
$black_can_castle_queenside = $_SESSION['black_can_castle_queenside'];
$en_passant_target = $_SESSION['en_passant_target'];
$halfmove_clock = $_SESSION['halfmove_clock'];
$fullmove_number = $_SESSION['fullmove_number'];
$king_positions = $_SESSION['king_positions'];

// Función para obtener el color de una pieza
function getPieceColor($piece) {
    if (empty($piece)) return null;
    return ctype_lower($piece) ? WHITE : BLACK;
}

// Función para obtener el tipo de pieza (en minúscula)
function getPieceType($piece) {
    if (empty($piece)) return null;
    return strtolower($piece);
}

// Función para verificar si una posición está dentro del tablero
function isPositionValid($row, $col) {
    return $row >= 0 && $row < 8 && $col >= 0 && $col < 8;
}

// Función para verificar si una casilla está vacía
function isEmpty($board, $row, $col) {
    return empty($board[$row][$col]);
}

// Función para verificar si una casilla contiene una pieza enemiga
function isEnemy($board, $row, $col, $current_player) {
    if (!isPositionValid($row, $col) || isEmpty($board, $row, $col)) return false;
    return getPieceColor($board[$row][$col]) !== $current_player;
}

// Función para verificar si una casilla contiene una pieza aliada
function isAlly($board, $row, $col, $current_player) {
    if (!isPositionValid($row, $col) || isEmpty($board, $row, $col)) return false;
    return getPieceColor($board[$row][$col]) === $current_player;
}

// Función para verificar si un cuadrado está bajo ataque
function isSquareUnderAttack($board, $row, $col, $attacker_color) {
    for ($r = 0; $r < 8; $r++) {
        for ($c = 0; $c < 8; $c++) {
            $piece = $board[$r][$c];
            if (!empty($piece) && getPieceColor($piece) === $attacker_color) {
                $moves = calculatePossibleMoves($board, $r, $c, $attacker_color, null, false);
                if (is_array($moves)) {
                    foreach ($moves as $move) {
                        if (is_array($move) && isset($move[0], $move[1])) {
                            if ($move[0] == $row && $move[1] == $col) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
    return false;
}

// Función para encontrar la posición del rey
function findKingPosition($board, $color) {
    $king = ($color === WHITE) ? 'k' : 'K';
    
    for ($row = 0; $row < 8; $row++) {
        for ($col = 0; $col < 8; $col++) {
            if ($board[$row][$col] === $king) {
                return [$row, $col];
            }
        }
    }
    return null;
}

// Función auxiliar para obtener posición válida del rey
function getValidKingPosition($board, $king_color, $king_pos = null) {
    if ($king_pos !== null && is_array($king_pos) && count($king_pos) === 2) {
        $king_row = $king_pos[0];
        $king_col = $king_pos[1];
        
        if (is_numeric($king_row) && is_numeric($king_col) && 
            isPositionValid($king_row, $king_col) && 
            $board[$king_row][$king_col] === ($king_color === WHITE ? 'k' : 'K')) {
            return $king_pos;
        }
    }
    
    $king = $king_color === WHITE ? 'k' : 'K';
    
    for ($row = 0; $row < 8; $row++) {
        for ($col = 0; $col < 8; $col++) {
            if ($board[$row][$col] === $king) {
                return [$row, $col];
            }
        }
    }
    
    return null;
}

// Función para verificar si el rey está en jaque (versión corregida)
function isKingInCheck($board, $king_color, $king_pos = null) {
    $king_pos = getValidKingPosition($board, $king_color, $king_pos);
    
    if ($king_pos === null) {
        return false;
    }

    $enemy_color = ($king_color === WHITE) ? BLACK : WHITE;
    
    for ($row = 0; $row < 8; $row++) {
        for ($col = 0; $col < 8; $col++) {
            $piece = $board[$row][$col];
            if (!empty($piece) && getPieceColor($piece) === $enemy_color) {
                $moves = calculatePossibleMoves($board, $row, $col, $enemy_color, null, false);
                
                if (is_array($moves)) {
                    foreach ($moves as $move) {
                        if (is_array($move) && isset($move[0], $move[1])) {
                            if ($move[0] == $king_pos[0] && $move[1] == $king_pos[1]) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
    
    return false;
}

// Función para calcular movimientos posibles para una pieza
function calculatePossibleMoves($board, $row, $col, $current_player, $en_passant_target, $check_king_safety = true) {
    if (empty($board[$row][$col])) {
        return [];
    }
    
    $piece = $board[$row][$col];
    $piece_type = getPieceType($piece);
    $moves = [];
    $captures = [];
    $special_moves = [];

    $pawn_direction = ($current_player === WHITE) ? -1 : 1;

    switch ($piece_type) {
        case PAWN:
            if (isPositionValid($row + $pawn_direction, $col) && isEmpty($board, $row + $pawn_direction, $col)) {
                $moves[] = [$row + $pawn_direction, $col];
                
                if (($current_player === WHITE && $row === 6) || ($current_player === BLACK && $row === 1)) {
                    if (isEmpty($board, $row + 2 * $pawn_direction, $col)) {
                        $moves[] = [$row + 2 * $pawn_direction, $col];
                    }
                }
            }
            
            foreach ([-1, 1] as $dc) {
                $new_col = $col + $dc;
                $new_row = $row + $pawn_direction;
                
                if (isPositionValid($new_row, $new_col)) {
                    if (isEnemy($board, $new_row, $new_col, $current_player)) {
                        $captures[] = [$new_row, $new_col];
                    }
                    
                    if (is_array($en_passant_target) && $new_row == $en_passant_target[0] && $new_col == $en_passant_target[1]) {
                        $captures[] = [$new_row, $new_col, 'en_passant'];
                    }
                }
            }
            break;
            
        case KNIGHT:
            $knight_moves = [
                [-2, -1], [-2, 1], [-1, -2], [-1, 2],
                [1, -2], [1, 2], [2, -1], [2, 1]
            ];
            
            foreach ($knight_moves as $move) {
                $new_row = $row + $move[0];
                $new_col = $col + $move[1];
                
                if (isPositionValid($new_row, $new_col)) {
                    if (isEmpty($board, $new_row, $new_col)) {
                        $moves[] = [$new_row, $new_col];
                    } elseif (isEnemy($board, $new_row, $new_col, $current_player)) {
                        $captures[] = [$new_row, $new_col];
                    }
                }
            }
            break;
            
        case BISHOP:
            $directions = [[-1, -1], [-1, 1], [1, -1], [1, 1]];
            foreach ($directions as $dir) {
                for ($i = 1; $i < 8; $i++) {
                    $new_row = $row + $dir[0] * $i;
                    $new_col = $col + $dir[1] * $i;
                    
                    if (!isPositionValid($new_row, $new_col)) break;
                    
                    if (isEmpty($board, $new_row, $new_col)) {
                        $moves[] = [$new_row, $new_col];
                    } else {
                        if (isEnemy($board, $new_row, $new_col, $current_player)) {
                            $captures[] = [$new_row, $new_col];
                        }
                        break;
                    }
                }
            }
            break;
            
        case ROOK:
            $directions = [[-1, 0], [1, 0], [0, -1], [0, 1]];
            foreach ($directions as $dir) {
                for ($i = 1; $i < 8; $i++) {
                    $new_row = $row + $dir[0] * $i;
                    $new_col = $col + $dir[1] * $i;
                    
                    if (!isPositionValid($new_row, $new_col)) break;
                    
                    if (isEmpty($board, $new_row, $new_col)) {
                        $moves[] = [$new_row, $new_col];
                    } else {
                        if (isEnemy($board, $new_row, $new_col, $current_player)) {
                            $captures[] = [$new_row, $new_col];
                        }
                        break;
                    }
                }
            }
            break;
            
        case QUEEN:
            $directions = [
                [-1, 0], [1, 0], [0, -1], [0, 1],
                [-1, -1], [-1, 1], [1, -1], [1, 1]
            ];
            
            foreach ($directions as $dir) {
                for ($i = 1; $i < 8; $i++) {
                    $new_row = $row + $dir[0] * $i;
                    $new_col = $col + $dir[1] * $i;
                    
                    if (!isPositionValid($new_row, $new_col)) break;
                    
                    if (isEmpty($board, $new_row, $new_col)) {
                        $moves[] = [$new_row, $new_col];
                    } else {
                        if (isEnemy($board, $new_row, $new_col, $current_player)) {
                            $captures[] = [$new_row, $new_col];
                        }
                        break;
                    }
                }
            }
            break;
            
        case KING:
            for ($r = -1; $r <= 1; $r++) {
                for ($c = -1; $c <= 1; $c++) {
                    if ($r == 0 && $c == 0) continue;
                    
                    $new_row = $row + $r;
                    $new_col = $col + $c;
                    
                    if (isPositionValid($new_row, $new_col)) {
                        if (isEmpty($board, $new_row, $new_col)) {
                            $moves[] = [$new_row, $new_col];
                        } elseif (isEnemy($board, $new_row, $new_col, $current_player)) {
                            $captures[] = [$new_row, $new_col];
                        }
                    }
                }
            }
            
            if ($current_player === WHITE) {
                if ($_SESSION['white_can_castle_kingside'] && 
                    isEmpty($board, 7, 5) && isEmpty($board, 7, 6) &&
                    !isSquareUnderAttack($board, 7, 4, BLACK) &&
                    !isSquareUnderAttack($board, 7, 5, BLACK) &&
                    !isSquareUnderAttack($board, 7, 6, BLACK)) {
                    $special_moves[] = [7, 6, 'castle_kingside'];
                }
                
                if ($_SESSION['white_can_castle_queenside'] && 
                    isEmpty($board, 7, 1) && isEmpty($board, 7, 2) && isEmpty($board, 7, 3) &&
                    !isSquareUnderAttack($board, 7, 4, BLACK) &&
                    !isSquareUnderAttack($board, 7, 3, BLACK) &&
                    !isSquareUnderAttack($board, 7, 2, BLACK)) {
                    $special_moves[] = [7, 2, 'castle_queenside'];
                }
            } else {
                if ($_SESSION['black_can_castle_kingside'] && 
                    isEmpty($board, 0, 5) && isEmpty($board, 0, 6) &&
                    !isSquareUnderAttack($board, 0, 4, WHITE) &&
                    !isSquareUnderAttack($board, 0, 5, WHITE) &&
                    !isSquareUnderAttack($board, 0, 6, WHITE)) {
                    $special_moves[] = [0, 6, 'castle_kingside'];
                }
                
                if ($_SESSION['black_can_castle_queenside'] && 
                    isEmpty($board, 0, 1) && isEmpty($board, 0, 2) && isEmpty($board, 0, 3) &&
                    !isSquareUnderAttack($board, 0, 4, WHITE) &&
                    !isSquareUnderAttack($board, 0, 3, WHITE) &&
                    !isSquareUnderAttack($board, 0, 2, WHITE)) {
                    $special_moves[] = [0, 2, 'castle_queenside'];
                }
            }
            break;
    }
    
    $all_moves = array_merge($moves, $captures, $special_moves);
    
    if ($check_king_safety) {
        $valid_moves = [];
        $king_pos = ($piece_type === KING) ? null : $_SESSION['king_positions'][$current_player];
        
        foreach ($all_moves as $move) {
            if (!is_array($move) || count($move) < 2) continue;
            
            $simulated_board = $board;
            $simulated_board[$move[0]][$move[1]] = $piece;
            $simulated_board[$row][$col] = '';
            
            if (isset($move[2]) && $move[2] === 'en_passant') {
                $captured_pawn_row = ($current_player === WHITE) ? $move[0] + 1 : $move[0] - 1;
                $simulated_board[$captured_pawn_row][$move[1]] = '';
            }
            
            if (isset($move[2]) && strpos($move[2], 'castle') !== false) {
                if ($move[2] === 'castle_kingside') {
                    $simulated_board[$move[0]][$move[1] - 1] = ($current_player === WHITE) ? 'r' : 'R';
                    $simulated_board[$move[0]][7] = '';
                } else {
                    $simulated_board[$move[0]][$move[1] + 1] = ($current_player === WHITE) ? 'r' : 'R';
                    $simulated_board[$move[0]][0] = '';
                }
            }
            
            $simulated_king_pos = $king_pos;
            if ($piece_type === KING) {
                $simulated_king_pos = [$move[0], $move[1]];
            }
            
            if (!isKingInCheck($simulated_board, $current_player, $simulated_king_pos)) {
                $valid_moves[] = $move;
            }
        }
        
        return $valid_moves;
    }
    
    return $all_moves;
}

// Función para verificar si hay jaque mate
function isCheckmate($board, $current_player) {
    $king_pos = findKingPosition($board, $current_player);
    if (!isKingInCheck($board, $current_player, $king_pos)) {
        return false;
    }
    
    for ($row = 0; $row < 8; $row++) {
        for ($col = 0; $col < 8; $col++) {
            $piece = $board[$row][$col];
            if (!empty($piece) && getPieceColor($piece) === $current_player) {
                $moves = calculatePossibleMoves($board, $row, $col, $current_player, null);
                if (!empty($moves)) {
                    return false;
                }
            }
        }
    }
    
    return true;
}

// Función para verificar si hay tablas (ahogado)
function isStalemate($board, $current_player) {
    if (isKingInCheck($board, $current_player)) {
        return false;
    }
    
    for ($row = 0; $row < 8; $row++) {
        for ($col = 0; $col < 8; $col++) {
            $piece = $board[$row][$col];
            if (!empty($piece) && getPieceColor($piece) === $current_player) {
                $moves = calculatePossibleMoves($board, $row, $col, $current_player, null);
                if (!empty($moves)) {
                    return false;
                }
            }
        }
    }
    
    return true;
}

// Función para convertir coordenadas a notación algebraica
function toAlgebraicNotation($row, $col) {
    $letters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
    return $letters[$col] . (8 - $row);
}

// Función para obtener el símbolo Unicode de una pieza
function getPieceSymbol($piece) {
    if (empty($piece)) return '';
    
    $symbols = [
        'r' => '&#9814;', 'R' => '&#9820;',
        'n' => '&#9816;', 'N' => '&#9822;',
        'b' => '&#9815;', 'B' => '&#9821;',
        'q' => '&#9813;', 'Q' => '&#9819;',
        'k' => '&#9812;', 'K' => '&#9818;',
        'p' => '&#9817;', 'P' => '&#9823;'
    ];
    
    return $symbols[$piece] ?? '';
}

// Función para convertir movimiento a notación algebraica
function moveToAlgebraic($move_record) {
    if (!is_array($move_record)) return '';
    
    $piece = $move_record['piece'] ?? '';
    $piece_type = strtolower($piece);
    $from = $move_record['from'] ?? [0, 0];
    $to = $move_record['to'] ?? [0, 0];
    $captured = $move_record['captured'] ?? '';
    $type = $move_record['type'] ?? 'normal';
    
    $notation = '';
    
    if ($type === 'castle_kingside') return 'O-O';
    if ($type === 'castle_queenside') return 'O-O-O';
    
    if ($piece_type !== 'p') $notation .= strtoupper($piece_type);
    
    if (!empty($captured)) {
        if ($piece_type === 'p') $notation .= substr(toAlgebraicNotation($from[0], $from[1]), 0, 1);
        $notation .= 'x';
    }
    
    $notation .= toAlgebraicNotation($to[0], $to[1]);
    
    if (isset($move_record['promotion'])) $notation .= '=' . strtoupper($move_record['promotion']);
    
    return $notation;
}

// Manejar selección de pieza
if (isset($_GET['select']) && !$promotion_pending) {
    $pos = explode(',', $_GET['select']);
    if (count($pos) === 2) {
        $row = (int)$pos[0];
        $col = (int)$pos[1];
        
        if (!empty($board[$row][$col])) {
            $piece = $board[$row][$col];
            
            if (getPieceColor($piece) === $current_player) {
                $selected_piece = [$row, $col];
                $possible_moves = calculatePossibleMoves($board, $row, $col, $current_player, $en_passant_target);
                
                if (empty($possible_moves)) {
                    $message = "Esta pieza no tiene movimientos válidos";
                    $message_type = "error";
                    $selected_piece = null;
                } else {
                    $message = "Pieza seleccionada. Elige destino.";
                    $message_type = "info";
                }
            } else {
                $message = "No es tu pieza. Turno de las " . ($current_player === WHITE ? 'Blancas' : 'Negras');
                $message_type = "error";
            }
        } else {
            $selected_piece = null;
            $possible_moves = [];
        }
    }
}

// Manejar movimiento de pieza
if (isset($_GET['move']) && $selected_piece && !$promotion_pending) {
    $from_row = $selected_piece[0];
    $from_col = $selected_piece[1];
    $to_pos = explode(',', $_GET['move']);
    
    if (count($to_pos) === 2) {
        $to_row = (int)$to_pos[0];
        $to_col = (int)$to_pos[1];
        
        $is_valid_move = false;
        $move_type = 'normal';
        
        foreach ($possible_moves as $move) {
            if ($move[0] === $to_row && $move[1] === $to_col) {
                $is_valid_move = true;
                if (isset($move[2])) $move_type = $move[2];
                break;
            }
        }
        
        if ($is_valid_move) {
            $piece = $board[$from_row][$from_col];
            $piece_type = getPieceType($piece);
            $captured_piece = $board[$to_row][$to_col];
            
            $move_record = [
                'piece' => $piece,
                'from' => [$from_row, $from_col],
                'to' => [$to_row, $to_col],
                'type' => $move_type,
                'captured' => $captured_piece,
                'halfmove_clock' => $halfmove_clock,
                'castling_rights' => [
                    'white_kingside' => $white_can_castle_kingside,
                    'white_queenside' => $white_can_castle_queenside,
                    'black_kingside' => $black_can_castle_kingside,
                    'black_queenside' => $black_can_castle_queenside
                ]
            ];
            
            $board[$to_row][$to_col] = $piece;
            $board[$from_row][$from_col] = '';
            
            if ($piece_type === KING) {
                $king_positions[$current_player] = [$to_row, $to_col];
                
                if ($move_type === 'castle_kingside') {
                    $rook_col = 7;
                    $new_rook_col = 5;
                    $board[$to_row][$new_rook_col] = ($current_player === WHITE) ? 'r' : 'R';
                    $board[$to_row][$rook_col] = '';
                    
                    $move_record['rook_from'] = [$to_row, $rook_col];
                    $move_record['rook_to'] = [$to_row, $new_rook_col];
                } elseif ($move_type === 'castle_queenside') {
                    $rook_col = 0;
                    $new_rook_col = 3;
                    $board[$to_row][$new_rook_col] = ($current_player === WHITE) ? 'r' : 'R';
                    $board[$to_row][$rook_col] = '';
                    
                    $move_record['rook_from'] = [$to_row, $rook_col];
                    $move_record['rook_to'] = [$to_row, $new_rook_col];
                }
                
                if ($current_player === WHITE) {
                    $white_can_castle_kingside = false;
                    $white_can_castle_queenside = false;
                } else {
                    $black_can_castle_kingside = false;
                    $black_can_castle_queenside = false;
                }
            }
            
            if ($move_type === 'en_passant') {
                $captured_pawn_row = ($current_player === WHITE) ? $to_row + 1 : $to_row - 1;
                $move_record['captured'] = $board[$captured_pawn_row][$to_col];
                $move_record['captured_pos'] = [$captured_pawn_row, $to_col];
                $board[$captured_pawn_row][$to_col] = '';
            }
            
            $en_passant_target = null;
            if ($piece_type === PAWN && abs($to_row - $from_row) === 2) {
                $en_passant_target_row = ($current_player === WHITE) ? $to_row + 1 : $to_row - 1;
                $en_passant_target = [$en_passant_target_row, $to_col];
            }
            
            if ($piece_type === ROOK) {
                if ($current_player === WHITE) {
                    if ($from_row === 7 && $from_col === 0) $white_can_castle_queenside = false;
                    if ($from_row === 7 && $from_col === 7) $white_can_castle_kingside = false;
                } else {
                    if ($from_row === 0 && $from_col === 0) $black_can_castle_queenside = false;
                    if ($from_row === 0 && $from_col === 7) $black_can_castle_kingside = false;
                }
            }
            
            if (!empty($captured_piece) && getPieceType($captured_piece) === ROOK) {
                if ($current_player === WHITE) {
                    if ($to_row === 0 && $to_col === 0) $black_can_castle_queenside = false;
                    if ($to_row === 0 && $to_col === 7) $black_can_castle_kingside = false;
                } else {
                    if ($to_row === 7 && $to_col === 0) $white_can_castle_queenside = false;
                    if ($to_row === 7 && $to_col === 7) $white_can_castle_kingside = false;
                }
            }
            
            if ($piece_type === PAWN || !empty($captured_piece)) {
                $halfmove_clock = 0;
            } else {
                $halfmove_clock++;
            }
            
            if ($current_player === BLACK) $fullmove_number++;
            
            if ($piece_type === PAWN && ($to_row === 0 || $to_row === 7)) {
                $promotion_pending = true;
                $pawn_to_promote_pos = [$to_row, $to_col];
                $message = "¡Peón a coronar! Elige una pieza.";
                $message_type = "promotion-active";
            } else {
                $current_player = ($current_player === WHITE) ? BLACK : WHITE;
                
                $opponent_king_pos = $king_positions[$current_player];
                if (isKingInCheck($board, $current_player, $opponent_king_pos)) {
                    if (isCheckmate($board, $current_player)) {
                        $winner = ($current_player === WHITE) ? 'Negras' : 'Blancas';
                        $message = "¡Jaque mate! Ganaron las $winner";
                        $message_type = "checkmate";
                    } else {
                        $message = "Turno de las " . ($current_player === WHITE ? 'Blancas (¡Jaque!)' : 'Negras (¡Jaque!)');
                        $message_type = "check";
                    }
                } else {
                    if (isStalemate($board, $current_player)) {
                        $message = "¡Tablas por ahogado!";
                        $message_type = "error";
                    } else {
                        $message = "Turno de las " . ($current_player === WHITE ? 'Blancas' : 'Negras');
                        $message_type = "info";
                    }
                }
            }
            
            $move_record['new_position'] = $board;
            $move_record['new_player'] = $current_player;
            $move_record['new_en_passant'] = $en_passant_target;
            $move_record['new_halfmove'] = $halfmove_clock;
            $move_record['new_fullmove'] = $fullmove_number;
            $move_record['new_castling'] = [
                'white_kingside' => $white_can_castle_kingside,
                'white_queenside' => $white_can_castle_queenside,
                'black_kingside' => $black_can_castle_kingside,
                'black_queenside' => $black_can_castle_queenside
            ];
            
            $move_history[] = $move_record;
        } else {
            $message = "Movimiento no válido";
            $message_type = "error";
        }
        
        $selected_piece = null;
        $possible_moves = [];
    }
}

// Manejar promoción de peón
if ($promotion_pending && isset($_GET['promote_to'])) {
    $promotion_piece = $_GET['promote_to'];
    $row = $pawn_to_promote_pos[0];
    $col = $pawn_to_promote_pos[1];
    
    $valid_promotions = ['Q', 'R', 'B', 'N'];
    if (in_array(strtoupper($promotion_piece), $valid_promotions)) {
        if ($current_player === WHITE) {
            $board[$row][$col] = strtolower($promotion_piece);
        } else {
            $board[$row][$col] = strtoupper($promotion_piece);
        }
        
        $promotion_pending = false;
        $pawn_to_promote_pos = null;
        $current_player = ($current_player === WHITE) ? BLACK : WHITE;
        
        $opponent_king_pos = $king_positions[$current_player];
        if (isKingInCheck($board, $current_player, $opponent_king_pos)) {
            if (isCheckmate($board, $current_player)) {
                $winner = ($current_player === WHITE) ? 'Negras' : 'Blancas';
                $message = "¡Jaque mate! Ganaron las $winner";
                $message_type = "checkmate";
            } else {
                $message = "Turno de las " . ($current_player === WHITE ? 'Blancas (¡Jaque!)' : 'Negras (¡Jaque!)');
                $message_type = "check";
            }
        } else {
            if (isStalemate($board, $current_player)) {
                $message = "¡Tablas por ahogado!";
                $message_type = "error";
            } else {
                $message = "Turno de las " . ($current_player === WHITE ? 'Blancas' : 'Negras');
                $message_type = "info";
            }
        }
    } else {
        $message = "Promoción no válida";
        $message_type = "error";
    }
}

// Actualizar variables de sesión
$_SESSION['chess_board'] = $board;
$_SESSION['current_player'] = $current_player;
$_SESSION['message'] = $message;
$_SESSION['message_type'] = $message_type;
$_SESSION['promotion_pending'] = $promotion_pending;
$_SESSION['pawn_to_promote_pos'] = $pawn_to_promote_pos;
$_SESSION['selected_piece'] = $selected_piece;
$_SESSION['possible_moves'] = $possible_moves;
$_SESSION['move_history'] = $move_history;
$_SESSION['white_can_castle_kingside'] = $white_can_castle_kingside;
$_SESSION['white_can_castle_queenside'] = $white_can_castle_queenside;
$_SESSION['black_can_castle_kingside'] = $black_can_castle_kingside;
$_SESSION['black_can_castle_queenside'] = $black_can_castle_queenside;
$_SESSION['en_passant_target'] = $en_passant_target;
$_SESSION['halfmove_clock'] = $halfmove_clock;
$_SESSION['fullmove_number'] = $fullmove_number;
$_SESSION['king_positions'] = $king_positions;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajedrez PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        
        .chess-board {
            display: grid;
            grid-template-columns: repeat(8, 60px);
            grid-template-rows: repeat(8, 60px);
            border: 2px solid #333;
            margin-bottom: 20px;
        }
        
        .square {
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 40px;
            cursor: pointer;
            position: relative;
        }
        
        .light {
            background-color: #f0d9b5;
        }
        
        .dark {
            background-color: #b58863;
        }
        
        .selected {
            background-color: #a9a9ff;
        }
        
        .possible-move {
            background-color: rgba(169, 169, 255, 0.5);
        }
        
        .possible-capture {
            background-color: rgba(255, 0, 0, 0.5);
        }
        
        .message {
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        .info {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .check {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        
        .checkmate {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        .promotion-active {
            background-color: #e2e3e5;
            color: #383d41;
            border: 1px solid #d6d8db;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }
        
        .promotion-options {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .promotion-option {
            font-size: 30px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            background-color: white;
        }
        
        .promotion-option:hover {
            background-color: #f0f0f0;
        }
        
        .controls {
            margin-bottom: 20px;
        }
        
        button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        
        button:hover {
            background-color: #45a049;
        }
        
        .move-history {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            background-color: white;
            width: 300px;
        }
        
        .move-entry {
            padding: 5px;
            border-bottom: 1px solid #eee;
        }
        
        .move-entry:nth-child(odd) {
            background-color: #f9f9f9;
        }
        
        .coordinates {
            position: absolute;
            font-size: 10px;
            pointer-events: none;
        }
        
        .file-coords {
            bottom: 2px;
            right: 2px;
        }
        
        .rank-coords {
            top: 2px;
            left: 2px;
        }
    </style>
</head>
<body>
    <h1>Ajedrez en PHP</h1>
    
    <div class="message <?php echo $message_type; ?>">
        <?php echo $message; ?>
    </div>
    
    <div class="controls">
        <a href="?reset=1"><button>Reiniciar Juego</button></a>
    </div>
    
    <div class="chess-board">
        <?php for ($row = 0; $row < 8; $row++): ?>
            <?php for ($col = 0; $col < 8; $col++): ?>
                <?php 
                    $is_light = ($row + $col) % 2 === 0;
                    $square_class = $is_light ? 'light' : 'dark';
                    
                    if ($selected_piece && $selected_piece[0] == $row && $selected_piece[1] == $col) {
                        $square_class .= ' selected';
                    }
                    
                    $is_possible_move = false;
                    $is_possible_capture = false;
                    
                    if ($selected_piece) {
                        foreach ($possible_moves as $move) {
                            if ($move[0] == $row && $move[1] == $col) {
                                if (!empty($board[$row][$col])) {
                                    $is_possible_capture = true;
                                } else {
                                    $is_possible_move = true;
                                }
                                break;
                            }
                        }
                    }
                    
                    if ($is_possible_move) $square_class .= ' possible-move';
                    if ($is_possible_capture) $square_class .= ' possible-capture';
                    
                    $piece = $board[$row][$col];
                    $piece_symbol = getPieceSymbol($piece);
                ?>
                <div class="square <?php echo $square_class; ?>" 
                     onclick="location.href='<?php echo $selected_piece ? '?move='.$row.','.$col : '?select='.$row.','.$col; ?>'">
                    <span class="coordinates rank-coords"><?php echo 8 - $row; ?></span>
                    <span class="coordinates file-coords"><?php echo chr(97 + $col); ?></span>
                    <?php if (!empty($piece_symbol)): ?>
                        <span><?php echo $piece_symbol; ?></span>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        <?php endfor; ?>
    </div>
    <div>    <?php
    // En 3raya/index.php, ajedrez/index.php, etc.

    // ... Tu código PHP

    // Incluir el footer.php que está un nivel arriba
    include '../footer.php';

    // O, si quieres asegurarte de que solo se incluya una vez y parar la ejecución si no se encuentra:
    // require_once '../footer.php';
    ?></div>
    <?php if ($promotion_pending): ?>
        <div class="promotion-active">
            <p>¡Peón a coronar! Elige una pieza:</p>
            <div class="promotion-options">
                <a href="?promote_to=Q"><span class="promotion-option">&#9813;</span></a>
                <a href="?promote_to=R"><span class="promotion-option">&#9814;</span></a>
                <a href="?promote_to=B"><span class="promotion-option">&#9815;</span></a>
                <a href="?promote_to=N"><span class="promotion-option">&#9816;</span></a>
            </div>
        </div>
    <?php endif; ?>
    
    <h2>Historial de Movimientos</h2>
    <div class="move-history">
        <?php foreach ($move_history as $index => $move): ?>
            <div class="move-entry">
                <?php echo ($index + 1) . '. ' . moveToAlgebraic($move); ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>