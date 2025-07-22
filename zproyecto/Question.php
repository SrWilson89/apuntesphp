<?php
class Question {
    public $text;
    public $options;
    public $correct;

    public function __construct($text, $options, $correct) {
        $this->text = $text;
        $this->options = $options;
        $this->correct = (int)$correct;
    }
}
?>