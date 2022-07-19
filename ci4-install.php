#!/usr/bin/env php
<?php

if ($argc < 2) {
    file_put_contents(
        'php://stderr',
        'Usage: php ci4-install.php <directory> [<version>]' . PHP_EOL
        . '   Eg: php ci4-install.php ci4app 4.1.9' . PHP_EOL
    );

    exit(1);
}

$dir = $argv[1];

function runCommand(array $command): void
{
    echo '[ci4-install] ' . implode(' ', $command) . PHP_EOL;

    $descriptor = [
        0 => STDIN,
        1 => STDOUT,
        2 => STDERR,
    ];
    $process = proc_open($command, $descriptor, $pipes);

    if (! is_resource($process)) {
        throw new RuntimeException(
            'Cannot execute command: "' . implode(' ', $command) . '"'
        );
    }

    $status = proc_get_status($process);
    while ($status['running']) {
        usleep(100000);
        $status = proc_get_status($process);
    }

    proc_close($process);

    $exitCode = $status['exitcode'];
    //echo $exitCode . PHP_EOL;

    if ($exitCode !== 0) {
        throw new RuntimeException(
            'Command failed: "' . implode(' ', $command) . '"'
        );
    }
}

// install the latest version
if ($argc === 2) {
    $command = ['composer', 'create-project', 'codeigniter4/appstarter', $dir];
    runCommand($command);

    exit(0);
}

// install the specific version
$version = $argv[2];

$command = ['composer', 'create-project', 'codeigniter4/appstarter:' . $version, $dir];
runCommand($command);

chdir($dir);

$command = ['composer', 'require', '-W', 'codeigniter4/framework:' . $version];
runCommand($command);

echo '[ci4-install] ' . 'update "codeigniter4/framework" version in composer.json' . PHP_EOL;
$composerJsonPath = "composer.json";
$composerJson = file_get_contents($composerJsonPath);
$newComposerJson = preg_replace(
    '!"codeigniter4/framework": ".*?"!',
    '"codeigniter4/framework": "^' . $version . '"',
    $composerJson
);
file_put_contents($composerJsonPath, $newComposerJson);
