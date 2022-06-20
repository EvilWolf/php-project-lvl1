<?php

namespace BrainGames\Questions;

use BrainGames\Contracts\QuestionContract;
use Exception;

/**
 * Greatest common divisor game question
 */
class GCDQuestion implements QuestionContract
{
    private string $question;
    private string $correctAnswer;

    /**
     * Generate question and calculate correct answer
     * @throws Exception
     */
    public function __construct()
    {
        $left = $this->getRandomNumber();
        $right = $this->getRandomNumber();

        $this->question = "$left $right";
        $this->correctAnswer = $this->calculateAnswer($left, $right);
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

    /**
     * Calculate correct answer
     * @param int $left number
     * @param int $right number
     * @return string answer
     * @throws Exception
     */
    private function calculateAnswer(int $left, int $right): string
    {
        return strval(($left % $right) ? $this->calculateAnswer($right, $left % $right) : $right);
    }
}
