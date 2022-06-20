<?php

namespace BrainGames\Lang;

use Exception;

class Messages
{
    /**
     * @var array<string, string> list of messages
     */
    private array $messages;

    /**
     * Load language
     * @throws Exception
     */
    public function __construct($lang)
    {
        $this->messages = $this->load($lang);
    }

    /**
     * Check language key is exist
     * @param $key
     * @return bool
     */
    public function exists($key): bool
    {
        return array_key_exists($key, $this->messages);
    }

    /**
     * Return language string with replaced placeholders
     * @param $key string key message
     * @param $replace array<string, string> for replace placeholders
     * @return string message
     */
    public function get(string $key, array $replace = []): string
    {
        if ($this->exists($key)) {
            $keys = array_map(fn($key) => "%$key%", array_keys($replace));
            return str_replace($keys, array_values($replace), $this->messages[$key]);
        }

        return '';
    }

    /**
     * Load language from file {$lang}.php
     * @throws Exception
     */
    private function load($lang): array
    {
        $filePath = __DIR__ . "/$lang.php";
        if (is_readable($filePath)) {
            $messages = require($filePath);

            if (!is_array($messages)) {
                throw new Exception("Lang file $lang.php not contains array of messages.");
            }

            return $messages;
        }

        return [];
    }
}
