#!/usr/bin/env php
<?php

if ($argc < 3) {
    file_put_contents(
        'php://stderr',
        'Usage: php ci4-install.php <directory> <version>' . PHP_EOL
        . '   Eg: php ci4-install.php ci4app 4.1.9' . PHP_EOL
    );

    exit(1);
}

$dir = $argv[1];
$version = $argv[2];

$command = 'composer create-project codeigniter4/appstarter:' . $version . ' ' . $dir;
echo '[ci4-install] ' . $command . PHP_EOL;
passthru($command);

chdir($dir);

$command = 'composer require -W codeigniter4/framework:' . $version;
echo '[ci4-install] ' . $command . PHP_EOL;
passthru($command);

echo '[ci4-install] ' . 'update "codeigniter4/framework" version in composer.json'. PHP_EOL;
$composerJsonPath = "composer.json";
$composerJson = file_get_contents($composerJsonPath);
$newComposerJson = preg_replace(
    '!"codeigniter4/framework": ".*?"!',
    '"codeigniter4/framework": "^' . $version . '"',
    $composerJson
);
file_put_contents($composerJsonPath, $newComposerJson);
