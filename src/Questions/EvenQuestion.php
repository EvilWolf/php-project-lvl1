<?php

namespace BrainGames\Questions;

use BrainGames\Contracts\QuestionContract;
use Exception;

class EvenQuestion implements QuestionContract
{
    private string $question;
    private string $correctAnswer;

    /**
     * Generate question for even game
     * @throws Exception
     */
    public function __construct()
    {
        $this->question = $this->getRandomNumber();
        $this->correctAnswer = ($this->question % 2 === 0) ? 'yes' : 'no';
    }

    /**
     * @return string Question string
     */
    public function getQuestionString(): string
    {
        return $this->question;
    }

    /**
     * Return correct answer as string
     * @return string
     */
    public function correctAnswer(): string
    {
        return $this->correctAnswer;
    }

    /**
     * Random number between 1 and 99
     * @return int
     */
    private function getRandomNumber(): int
    {
        return rand(1, 99);
    }
}
