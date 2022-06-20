<?php

namespace BrainGames\Questions;

use BrainGames\Contracts\QuestionContract;
use Exception;

class CalculatorQuestion implements QuestionContract
{
    private string $question;
    private string $correctAnswer;

    /**
     * Generate question and calculate correct answer
     * @throws Exception
     */
    public function __construct()
    {
        $operator = $this->getRandomOperator();
        $left = $this->getRandomNumber();
        $right = $this->getRandomNumber();

        $this->question = "$left $operator $right";
        $this->correctAnswer = $this->calculateAnswer($operator, $left, $right);
    }

    /**
     * @return string Question string
     */
    public function getQuestionString(): string
    {
        return $this->question;
    }

    /**
     * Check answer is correct
     * @param string $answer
     * @return bool
     */
    public function isCorrect(string $answer): bool
    {
        return $this->correctAnswer === $answer;
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
     * Random calculation operator
     * @return string + - or *
     */
    private function getRandomOperator(): string
    {
        $operators = ['-', '+', '*'];
        return $operators[array_rand($operators)];
    }

    /**
     * Calculate correct answer
     * @param string $operator + - or *
     * @param int $left operand
     * @param int $right operand
     * @return string answer
     * @throws Exception
     */
    private function calculateAnswer(string $operator, int $left, int $right): string
    {
        switch ($operator) {
            case '+':
                return $left + $right;
            case '-':
                return $left - $right;
            case '*':
                return $left * $right;
            default:
                throw new Exception("Operator $operator not implemented!");
        }
    }
}
