<?php

namespace BrainGames\Games;

use BrainGames\Contracts\GameContract;
use BrainGames\Contracts\QuestionContract;
use BrainGames\Questions\PrimeQuestion;

class Prime implements GameContract
{
    /**
     * Return message key for headline question about all game.
     * @return string
     */
    public function getQuestionHeadMessageKey(): string
    {
        return 'prime-expression';
    }

    /**
     * Return object for generate question for game
     * @return QuestionContract
     */
    public function getQuestion(): QuestionContract
    {
        return new PrimeQuestion();
    }
}
