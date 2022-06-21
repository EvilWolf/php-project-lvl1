<?php

namespace BrainGames\Games\GCD;

use Exception;

use function BrainGames\Engine\getRandomNumber;

const MESSAGE_KEY = 'gcd-expression';

/**
 * Return closure with question generator
 * @throws Exception
 */
function questionGenerator(): callable
{
    return function () {
        $left = getRandomNumber();
        $right = getRandomNumber();

        $question = "$left $right";
        $correctAnswer = calculateAnswer($left, $right);

        return [$question, $correctAnswer];
    };
}

/**
 * Calculate correct answer
 * @param int $left number
 * @param int $right number
 * @return string answer
 * @throws Exception
 */
function calculateAnswer(int $left, int $right): string
{
    return strval(($left % $right !== 0) ? calculateAnswer($right, $left % $right) : $right);
}
