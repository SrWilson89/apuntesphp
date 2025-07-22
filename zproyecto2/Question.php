<?php

// Question.php

class Question {
    public $text;
    public $options; // Array de opciones
    public $correctAnswer; // La opción correcta (ej. 'B' o el valor de la opción)

    public function __construct(string $text, array $options, string $correctAnswer) {
        $this->text = $text;
        $this->options = $options;
        $this->correctAnswer = $correctAnswer;
    }

    public function isCorrect(string $userAnswer): bool {
        // Asumiendo que userAnswer será el texto de la opción seleccionada
        return strtolower(trim($userAnswer)) === strtolower(trim($this->correctAnswer));
    }
}

?>