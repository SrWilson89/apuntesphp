<?php

// Test.php

require_once 'Question.php'; // Asegúrate de incluir la clase Question

class Test {
    public $playerName;
    public $questions; // Array de objetos Question para este test
    public $currentQuestionIndex;
    public $playerAnswers; // Array para guardar las respuestas del jugador
    public $startTime;
    public $endTime;
    public $isCompleted;

    const MAX_QUESTIONS = 10; // Un test siempre tendrá 10 preguntas

    public function __construct(string $playerName = '') {
        $this->playerName = $playerName;
        $this->questions = [];
        $this->currentQuestionIndex = 0;
        $this->playerAnswers = [];
        $this->startTime = microtime(true); // Marca de tiempo al inicio del test
        $this->endTime = 0;
        $this->isCompleted = false;
    }

    // Carga 10 preguntas aleatorias del archivo TXT
    public function loadRandomQuestions(string $filePath): void {
        $allQuestionsData = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (empty($allQuestionsData)) {
            throw new Exception("El archivo de preguntas está vacío o no existe: " . $filePath);
        }

        $allQuestions = [];
        foreach ($allQuestionsData as $line) {
            $parts = explode('::', $line);
            if (count($parts) >= 6) { // Pregunta, 4 opciones, 1 respuesta correcta
                $questionText = array_shift($parts); // La primera parte es la pregunta
                $correctAnswer = array_pop($parts);  // La última parte es la respuesta correcta
                $options = $parts;                   // Lo que queda son las opciones
                $allQuestions[] = new Question($questionText, $options, $correctAnswer);
            }
        }

        // Selecciona 10 preguntas al azar
        if (count($allQuestions) < self::MAX_QUESTIONS) {
            throw new Exception("No hay suficientes preguntas en el archivo. Se necesitan " . self::MAX_QUESTIONS . ".");
        }
        $randomKeys = array_rand($allQuestions, self::MAX_QUESTIONS);
        shuffle($randomKeys); // Mezcla las claves para que no siempre salgan en el mismo orden
        foreach ($randomKeys as $key) {
            $this->questions[] = $allQuestions[$key];
        }
    }

    public function getCurrentQuestion(): ?Question {
        if ($this->currentQuestionIndex >= 0 && $this->currentQuestionIndex < count($this->questions)) {
            return $this->questions[$this->currentQuestionIndex];
        }
        return null;
    }

    public function recordAnswer(string $answer): void {
        $this->playerAnswers[$this->currentQuestionIndex] = $answer;
    }

    public function nextQuestion(): void {
        if ($this->currentQuestionIndex < count($this->questions) - 1) {
            $this->currentQuestionIndex++;
        } else {
            $this->completeTest();
        }
    }

    public function prevQuestion(): void {
        if ($this->currentQuestionIndex > 0) {
            $this->currentQuestionIndex--;
        }
    }

    public function getCorrectAnswersCount(): int {
        $correctCount = 0;
        foreach ($this->questions as $index => $question) {
            if (isset($this->playerAnswers[$index]) && $question->isCorrect($this->playerAnswers[$index])) {
                $correctCount++;
            }
        }
        return $correctCount;
    }

    public function getScorePercentage(): float {
        $correctCount = $this->getCorrectAnswersCount();
        return (count($this->questions) > 0) ? ($correctCount / count($this->questions)) * 100 : 0;
    }

    public function completeTest(): void {
        $this->endTime = microtime(true);
        $this->isCompleted = true;
    }

    public function getTestDuration(): string {
        if ($this->endTime == 0) {
            return "Test no completado";
        }
        $duration = $this->endTime - $this->startTime;
        $minutes = floor($duration / 60);
        $seconds = floor($duration % 60);
        return sprintf("%02d:%02d", $minutes, $seconds);
    }

    // Guarda los resultados de la partida en el archivo scores.txt
    public function saveGameResult(string $filePath): void {
        if (!$this->isCompleted) {
            return; // Solo guardar si el test está completo
        }

        $date = date('Y-m-d H:i:s');
        $resultLine = sprintf(
            "%s,%s,%d,%.2f,%s\n",
            $this->playerName,
            $date,
            $this->getCorrectAnswersCount(),
            $this->getScorePercentage(),
            $this->getTestDuration()
        );
        file_put_contents($filePath, $resultLine, FILE_APPEND);
    }

    // Métodos para serializar/deserializar el objeto para la cookie
    public function __sleep(): array {
        // Devuelve las propiedades que se deben serializar
        return ['playerName', 'questions', 'currentQuestionIndex', 'playerAnswers', 'startTime', 'endTime', 'isCompleted'];
    }

    public function __wakeup(): void {
        // No se necesita lógica especial al deserializar para este caso
    }
}

?>