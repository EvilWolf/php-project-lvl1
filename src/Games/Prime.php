<?php

namespace BrainGames\Games\Prime;

use Exception;

use function BrainGames\Engine\getRandomNumber;

const MESSAGE_KEY = 'prime-expression';

/**
 * Return closure with question generator
 * @throws Exception
 */
function questionGenerator(): callable
{
    return function () {
        $question = getRandomNumber();
        if (isPrime($question)) {
            $correctAnswer = 'yes';
        } else {
            $correctAnswer = 'no';
        }
        return [$question, $correctAnswer];
    };
}

/**
 * Check is prime number
 * @param $number
 * @return bool
 */
function isPrime($number): bool
{
    for ($x = 2; $x < $number; $x++) {
        if ($number % $x === 0) {
            return false;
        }
    }
    return true;
}
