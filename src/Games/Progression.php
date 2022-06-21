<?php

namespace BrainGames\Games\Progression;

use Exception;

const MESSAGE_KEY = 'progression-expression';
const MIN_SEQUENCE_LENGTH = 5;
const MAX_SEQUENCE_LENGTH = 12;

/**
 * Return closure with question generator
 * @throws Exception
 */
function questionGenerator(): callable
{
    return function () {
        // Generate sequence parameters
        $count = rand(MIN_SEQUENCE_LENGTH, MAX_SEQUENCE_LENGTH);
        $start = getRandomStart();
        $step = getRandomStep();
        $max = $start + ($step * ($count - 1));

        // Generate sequence
        $sequence = range($start, $max, $step);

        // Hide one key
        $missedKey = array_rand($sequence);
        $correctAnswer = strval($sequence[$missedKey]);
        $sequence[$missedKey] = '..';

        $question = implode(' ', $sequence);
        return [$question, $correctAnswer];
    };
}

/**
 * Random number between 1 and 22
 * 22 is random number, no requirement in task
 * @return int
 */
function getRandomStart(): int
{
    return rand(1, 22);
}

/**
 * Random number between 1 and 15
 * 15 is random number, no requirement in task
 * @return int
 */
function getRandomStep(): int
{
    return rand(1, 15);
}
