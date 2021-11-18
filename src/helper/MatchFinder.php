<?php

namespace App\Helper;

class MatchFinder
{
    public function __construct(protected string $path)
    {
    }


    protected function getContent(): string
    {
        if (! file_exists($this->path)) {
            throw new \RuntimeException('No such file: ' . $this->path);
        }

        $content = file_get_contents($this->path);

        if (empty($content)) {
            throw new \RuntimeException('File content is empty');
        }
        return $content;
    }

    protected function match(string $content): array
    {
        $matches = [];
        preg_match_all('/"(.*?)"/m', $content, $matches);
        return $matches;
    }

    protected function getMessage(array $matches): string
    {
        $message = 'No matches found';

        if (! empty($matches) && count($matches) > 1) {
            $wordsCount = count($matches[1]);
            $words = implode(', ', $matches[1]);
            $message = "Number of matches: ${wordsCount}. Matches: ${words}";
        }

        return  $message;
    }

    public function run(): string
    {
        $content = $this->getContent();
        $matches = $this->match($content);
        return $this->getMessage($matches);
    }
}
