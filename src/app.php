<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Console\Output\OutputInterface;
use Silly\Application;
use App\Helper\FileGenerator;
use App\Helper\MatchFinder;

$app = new Application('demo-def', '0.0.1');

$app->command('file path [chars] [nbQuoted]', function (string $path, OutputInterface $output, int $chars = 400, int $nbQuoted = 5) {
    $path .= '.txt';
    $realPath =  str_starts_with($path, '/') ? $path : __DIR__ . "/${path}";
    $fileGenerator = new FileGenerator($realPath, $chars, $nbQuoted);
    $resultFile = $fileGenerator->create();
    $output->writeln("File is created: ${resultFile}");
});

$app->command('find filePath', function ($filePath, OutputInterface $output) {
    $filePath.= '.txt';
    $realPath =  str_starts_with($filePath, '/') ? $filePath : __DIR__ . "/${filePath}";
    $finder = new MatchFinder($realPath);
    $output->writeln($finder->run());
});

$app->run();
