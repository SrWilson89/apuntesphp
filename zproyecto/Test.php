<?php
class Test {
    public $currentQuestion = 0;
    public $answers = [];
    public $startTime;

    public function __construct() {
        $this->startTime = time();
    }

    public function answer($answer) {
        $this->answers[$this->currentQuestion] = (int)$answer;
        $this->currentQuestion++;
    }

    public function getScore($questions) {
        $score = 0;
        foreach ($this->answers as $i => $answer) {
            if ($answer === $questions[$i]->correct) {
                $score++;
            }
        }
        return $score;
    }
}
?>