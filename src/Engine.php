<?php

namespace BrainGames\Engine;

use function cli\line;
use function cli\prompt;

const MAX_WINS = 3;

function getMessage(string $key, array $replace = [])
{
    $messages = [
        'greeting' => 'Welcome to the Brain Games!',
        'question-name' => 'May I have your name?',
        'greeting-name' => 'Hello, %username%!',
        'calculator-expression' => 'What is the result of the expression?',
        'gcd-expression' => 'Find the greatest common divisor of given numbers.',
        'progression-expression' => 'What number is missing in the progression?',
        'prime-expression' => 'Answer "yes" if given number is prime. Otherwise answer "no".',
        'even-expression' => 'Answer "yes" if the number is even, otherwise answer "no".',
        'question' => 'Question: %question%',
        'your-answer' => 'Your answer',
        'correct' => 'Correct!',
        'congratulations' => 'Congratulations, %username%!',
        'wrong' => '\'%wronganswer%\' is wrong answer ;(. Correct answer was \'%correctanswer%\'.',
        'try-again' => 'Let\'s try again, %username%!',
    ];

    $keys = array_map(fn($key) => "%$key%", array_keys($replace));
    return str_replace($keys, array_values($replace), $messages[$key]);
}

function greeting(): string
{
    line(getMessage('greeting'));
    $username = prompt(getMessage('question-name'), '', ' ');
    line(getMessage('greeting-name', ['username' => $username]));
    return $username;
}

function startGame(string $questionMessageKey, callable $questionGenerator)
{
    $username = greeting();
    line(getMessage($questionMessageKey));

    $wins = 0;
    while ($wins < MAX_WINS) {
        [$questionString, $correctAnswer] = $questionGenerator();
        line(getMessage('question', ['question' => $questionString]));
        $userAnswer = prompt(getMessage('your-answer'));

        if ($userAnswer === $correctAnswer) {
            $wins++;
            line(getMessage('correct'));
        } else {
            line(getMessage('wrong', ['wronganswer' => $userAnswer, 'correctanswer' => $correctAnswer]));
            line(getMessage('try-again', ['username' => $username]));
            return; // Exit if answer not correct
        }
    }

    line(getMessage('congratulations', ['username' => $username]));
}

/**
 * Random number between 1 and 99
 * @return int
 */
function getRandomNumber(): int
{
    return rand(1, 99);
}
