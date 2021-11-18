<?php

namespace App\Helper;

use Faker\Factory;

class FileGenerator
{
    public function __construct(protected string $path, private int $maxNbChars, private int $nbQuotedVal)
    {
    }

    protected function addDoubleQuotes(array $textAsArray): array
    {
        $keys = array_rand($textAsArray, $this->nbQuotedVal);
        foreach ($keys as $key) {
            $textAsArray[$key]  = '"' . $textAsArray[$key] . '"';
        }
        return $textAsArray;
    }

    protected function preparedText(): string
    {
        $faker = Factory::create();
        $text = $faker->text($this->maxNbChars);
        $textAsArray = explode(' ', $text);
        $res = $this->addDoubleQuotes($textAsArray);
        return implode(' ', $res);
    }

    public function create(): string
    {
        $result = file_put_contents($this->path, $this->preparedText());
        if (! $result) {
            throw new \RuntimeException('File not saved');
        }

        return $this->path;
    }
}
