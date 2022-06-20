<?php

namespace BrainGames\Questions;

use BrainGames\Contracts\QuestionContract;
use Exception;

class ProgressionQuestion implements QuestionContract
{
    private string $question;
    private string $correctAnswer;

    private const MIN_SEQUENCE_LENGTH = 5;
    private const MAX_SEQUENCE_LENGTH = 12;

    /**
     * Generate sequence for arithmetic progression game
     * @throws Exception
     */
    public function __construct()
    {
        $count = rand(self::MIN_SEQUENCE_LENGTH, self::MAX_SEQUENCE_LENGTH);
        $start = $this->getRandomStart();
        $step = $this->getRandomStep();
        $max = $start + ($step * ($count - 1));

        $sequence = range($start, $max, $step);

        $missedKey = array_rand($sequence);
        $this->correctAnswer = $sequence[$missedKey];
        $sequence[$missedKey] = '..';

        $this->question = implode(' ', $sequence);
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
     * Random number between 1 and 22
     * 22 is random number, no requirement in task
     * @return int
     */
    private function getRandomStart(): int
    {
        return rand(1, 22);
    }

    /**
     * Random number between 1 and 15
     * 15 is random number, no requirement in task
     * @return int
     */
    private function getRandomStep(): int
    {
        return rand(1, 15);
    }
}
