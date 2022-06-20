<?php

namespace BrainGames\Contracts;

interface GameContract
{
    public function getQuestionHeadMessageKey(): string;
    public function getQuestion(): QuestionContract;
}
