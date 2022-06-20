<?php

namespace BrainGames\Contracts;

interface QuestionContract
{
    public function getQuestionString(): string;
    public function isCorrect(string $answer): bool;
    public function correctAnswer(): string;
}
