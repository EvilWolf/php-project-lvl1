<?php

namespace BrainGames\Games\Calculator;

use Exception;
use function BrainGames\Engine\getRandomNumber;

const MESSAGE_KEY = 'calculator-expression';

/**
 * Return closure with question generator
 * @throws Exception
 */
function questionGenerator(): callable
{
    return function () {
        $operator = getRandomOperator();
        $left = getRandomNumber();
        $right = getRandomNumber();

        $question = "$left $operator $right";
        $correctAnswer = calculateAnswer($operator, $left, $right);

        return [$question, $correctAnswer];
    };
}

/**
 * Random calculation operator
 * @return string + - or *
 */
function getRandomOperator(): string
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
function calculateAnswer(string $operator, int $left, int $right): string
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
