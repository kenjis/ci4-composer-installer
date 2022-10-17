#!/usr/bin/env php
<?php

//--------------------------------------------------------------------
// Functions
//--------------------------------------------------------------------

function runCommand(array $command): void
{
    echo '[ci4-update] ' . implode(' ', $command) . PHP_EOL;

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
            'Command failed: "' . implode(' ', $command) . '"',
            $exitCode
        );
    }
}

function getFrameworkVersion(): string
{
    echo '[ci4-update] ' . 'get "codeigniter4/framework" version in composer.json' . PHP_EOL;
    $composerJsonPath = "composer.json";
    $composerJson = file_get_contents($composerJsonPath);
    $composer = json_decode($composerJson);

    return $composer->require->{'codeigniter4/framework'};
}

function updateFrameworkVersion(string $version): void
{
    echo '[ci4-update] ' . 'update "codeigniter4/codeigniter4" version in composer.json' . PHP_EOL;
    $composerJsonPath = "composer.json";
    $composerJson = file_get_contents($composerJsonPath);
    $newComposerJson = preg_replace(
        '!"codeigniter4/codeigniter4": ".*?"!',
        '"codeigniter4/codeigniter4": "' . $version . '"',
        $composerJson
    );
    file_put_contents($composerJsonPath, $newComposerJson);
}

//--------------------------------------------------------------------
// Main
//--------------------------------------------------------------------

if ($argc < 2) {
    file_put_contents(
        'php://stderr',
        'Usage: php ci4-update.php <branch>' . PHP_EOL
        . '   Eg: php ci4-update.php 4.3.x-dev' . PHP_EOL
    );

    exit(1);
}

$branch = $argv[1];

$currentVersion = getFrameworkVersion();

// Change the framework repository to `codeigniter4/codeigniter4`.
runCommand(['./builds', 'development']);
updateFrameworkVersion($currentVersion);
runCommand(['composer', 'update']);
runCommand(['git', 'add', '-u']);
runCommand(['git', 'commit', '-m', 'Change framework repository to "codeigniter4/codeigniter4"']);

// Install tatter/patches
runCommand(['composer', 'require', '--dev', 'tatter/patches']);
runCommand(['git', 'add', '-u']);
runCommand(['git', 'commit', '-m', 'Install "tatter/patches"']);

// Update framework version
updateFrameworkVersion($branch);
runCommand(['git', 'add', '-u']);
runCommand(['git', 'commit', '-m', 'Update framework version']);

// Run tatter/patches
try {
    runCommand(['vendor/bin/patch']);
} catch (RuntimeException $e) {
    echo $e->getMessage() . PHP_EOL;
    echo 'After resolving the conflict in "app/Config/Paths.php", run "git cherry-pick --continue".';
    echo PHP_EOL;
    echo ' And run "composer update", and check the diff: "git diff main...tatter/patches".';
    echo PHP_EOL;
    exit($e->getCode());
}
