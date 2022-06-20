<?php

namespace BrainGames;

use BrainGames\Contracts\GameContract;
use BrainGames\Lang\Messages;
use Exception;

use function cli\line;
use function cli\prompt;

class Engine
{
    private GameContract $game;
    private Messages $messages;
    private string $username;
    private const MAX_WINS = 3;

    /**
     * @throws Exception
     */
    public function __construct($lang = 'en')
    {
        $this->messages = new Messages($lang);
    }

    /**
     * @throws Exception
     */
    public function startGame(GameContract $gameClass)
    {
        $this->game = $gameClass;

        $this->greeting();
        $this->runGameLoop();
    }

    /**
     * @param string $key
     * @param array $replace
     * @return void
     */
    public function line(string $key, array $replace = [])
    {
        $message = $this->getMessage($key, $replace);
        line($message);
    }

    /**
     * @param string $key
     * @param array $replace
     * @param string $marker
     * @return string
     */
    public function prompt(string $key, array $replace = [], string $marker = ': '): string
    {
        $message = $this->getMessage($key, $replace);
        return prompt($message, false, $marker);
    }

    /**
     * @param string $key
     * @param array $replace
     * @return string
     */
    private function getMessage(string $key, array $replace = []): string
    {
        return $this->messages->get($key, $replace);
    }

    /**
     * @return void
     */
    private function greeting()
    {
        $this->line('greeting');
        $this->username = $this->prompt('question-name', [], ' ');
        $this->line('greeting-name', ['username' => $this->username]);

        $messageKey = $this->game->getQuestionHeadMessageKey();
        if (!empty($messageKey)) {
            $this->line($messageKey);
        }
    }

    /**
     * @return void
     */
    private function runGameLoop()
    {
        $wins = 0;
        while ($wins < self::MAX_WINS) {
            $question = $this->game->getQuestion();

            $this->line('question', ['question' => $question->getQuestionString()]);
            $userAnswer = $this->prompt('your-answer');
            if ($question->isCorrect($userAnswer)) {
                $wins++;
                $this->line('correct');
                continue;
            }

            $wins = 0;
            $this->line('wrong', ['wronganswer' => $userAnswer, 'correctanswer' => $question->correctAnswer()]);
            $this->line('try-again', ['username' => $this->username]);
        }

        $this->line('congratulations', ['username' => $this->username]);
    }
}
