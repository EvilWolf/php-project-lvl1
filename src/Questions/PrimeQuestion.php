<?php

namespace BrainGames\Questions;

use BrainGames\Contracts\QuestionContract;
use Exception;

class PrimeQuestion implements QuestionContract
{
    private string $question;
    private string $correctAnswer;

    /**
     * Generate prime number
     * @throws Exception
     */
    public function __construct()
    {
        $this->question = $this->getRandomNumber();
        if ($this->isPrime($this->question)) {
            $this->correctAnswer = 'yes';
        } else {
            $this->correctAnswer = 'no';
        }
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
     * @return int random number between 1 and 99
     */
    public function getRandomNumber(): int
    {
        return rand(1, 99);
    }

    public function isPrime($number): bool
    {
        for ($x = 2; $x < $number; $x++) {
            if ($number % $x === 0) {
                return false;
            }
        }
        return true;
    }
}
