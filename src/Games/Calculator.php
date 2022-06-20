<?php

namespace BrainGames\Games;

use BrainGames\Contracts\GameContract;
use BrainGames\Contracts\QuestionContract;
use BrainGames\Questions\CalculatorQuestion;

class Calculator implements GameContract
{
    /**
     * Return message key for headline question about all game.
     * @return string
     */
    public function getQuestionHeadMessageKey(): string
    {
        return 'calculator-expression';
    }

    /**
     * Return object for generate question for game
     * @return QuestionContract
     */
    public function getQuestion(): QuestionContract
    {
        return new CalculatorQuestion();
    }
}
