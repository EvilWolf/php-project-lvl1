<?php

namespace BrainGames\Contracts;

interface QuestionContract
{
    public function getQuestionString(): string;
    public function correctAnswer(): string;
}
