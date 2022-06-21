<?php

namespace BrainGames\Games\Even;

use Exception;

use function BrainGames\Engine\getRandomNumber;

const MESSAGE_KEY = 'even-expression';

/**
 * Return closure with question generator
 * @throws Exception
 */
function questionGenerator(): callable
{
    return function () {
        $question = getRandomNumber();
        $correctAnswer = ($question % 2 === 0) ? 'yes' : 'no';

        return [$question, $correctAnswer];
    };
}
