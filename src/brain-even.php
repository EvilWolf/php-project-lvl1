<?php

namespace BrainGames\Even;

use function cli\line;
use function cli\prompt;

function startGameEven(int $winAttempts = 3)
{
    $numbersRange = range(1, 99);
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?', false, ' ');
    line("Hello, %s!", $name);
    line('Answer "yes" if the number is even, otherwise answer "no".');

    $wins = 0;
    while ($wins < $winAttempts) {
        $number = $numbersRange[array_rand($numbersRange)];
        line("Question: {$number}");
        $correctAnswer = ($number % 2 === 0) ? 'yes' : 'no';

        $answer = prompt('Your answer');
        if ($answer === $correctAnswer) {
            $wins++;
            line('Correct!');
        } else {
            $wins = 0;
            line("'{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
            line("Let's try again, {$name}!");
        }
    }

    line("Congratulations, {$name}!");
}
