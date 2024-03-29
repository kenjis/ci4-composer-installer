# CodeIgniter4 Composer Installer <!-- omit in toc -->

- You can install previous versions of [CodeIgniter 4 app starter](https://github.com/codeigniter4/appstarter).
- You can upgrade CodeIgniter4 to next version branch.

> **Warning**
> Many of the older versions of CI4 have active [Security Advisories](https://github.com/codeigniter4/CodeIgniter4/security/advisories). So do not use them in a production environment.

- [Installing CodeIgniter4](#installing-codeigniter4)
- [Upgrading CodeIgniter4](#upgrading-codeigniter4)
  - [Tatter\Patches](#tatterpatches)
    - [Example: from v4.1.9 to v4.2.1 by Patches](#example-from-v419-to-v421-by-patches)
  - [Liaison Revision](#liaison-revision)
    - [Example: from v4.1.9 to v4.2.1 by Revision](#example-from-v419-to-v421-by-revision)
- [Upgrading CodeIgniter4 to next version branch](#upgrading-codeigniter4-to-next-version-branch)

## Installing CodeIgniter4

```console
$ php ci4-install.php <dir> [<version>]
```

The following command installs CodeIgniter 4.1.9:
```console
$ php ci4-install.php ci4app 4.1.9
```

## Upgrading CodeIgniter4

If you want to upgrade the older version of CI4 that you installed, you may need to upgrade Project Files (files in other than `system` folder).

You can do it manually according to [Upgrading From a Previous Version](https://codeigniter4.github.io/CodeIgniter4/installation/upgrading.html).

But if you use [tatter/patches](https://github.com/tattersoftware/codeigniter4-patches) or [liaison/revision](https://github.com/paulbalandan/liaison-revision), it is easier.

### Tatter\Patches

> **Note**
> **tatter/patches** is a shell script. So you need Unix Shell to run it.

#### Example: from v4.1.9 to v4.2.1 by Patches

Commit uncommitted changes in Git:
```console
$ git init
$ git add .
$ git commit -m "CodeIgniter 4.1.9"
```

Install "tatter/patches":
```console
$ composer require --dev tatter/patches
```

Commit uncommitted changes in Git:
```console
$ git add -u
$ git commit -m "add tatter/patches"
```

Run "tatter/patches":
```console
$ vendor/bin/patch
```

```console
git version 2.35.3
Composer version 2.3.9 2022-07-05 16:52:11
************************************
*          CONFIGURATION           *
************************************

Scripts Directory: /.../ci4app/vendor/tatter/patches/src
Project Directory: /.../ci4app
Target Version:    
Current Version:   
Source Package:    codeigniter4/framework
Base Branch:       main
Selected Items:    app/ public/ env spark

************************************
*             STAGING              *
************************************

Switched to a new branch 'tatter/scratch'
Loading composer repositories with package information
Updating dependencies
Lock file operations: 0 installs, 1 update, 0 removals
  - Upgrading codeigniter4/framework (v4.1.9 => v4.2.1)
Writing lock file
Installing dependencies from lock file (including require-dev)
Package operations: 0 installs, 1 update, 0 removals
  - Upgrading codeigniter4/framework (v4.1.9 => v4.2.1): Extracting archive
Generating autoload files
28 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
infection/extension-installer: No extensions found
[tatter/scratch d16f2e5] Patch framework
 26 files changed, 1330 insertions(+), 1223 deletions(-)
 rewrite Views/errors/html/debug.css (79%)
 rewrite Views/errors/html/debug.js (90%)
 rewrite Views/errors/html/error_404.php (95%)
 rewrite Views/errors/html/error_exception.php (82%)
 rewrite Views/errors/html/production.php (84%)
 rewrite Views/welcome_message.php (97%)
Switched to a new branch 'tatter/patches'
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Package operations: 0 installs, 1 update, 0 removals
  - Downgrading codeigniter4/framework (v4.2.1 => v4.1.9): Extracting archive
Generating autoload files
28 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
************************************
*              MERGING             *
************************************

[tatter/patches c20e281] Patch framework
 Date: Fri Jul 15 08:54:50 2022 +0900
 26 files changed, 1330 insertions(+), 1223 deletions(-)
 rewrite app/Views/errors/html/debug.css (79%)
 rewrite app/Views/errors/html/debug.js (90%)
 rewrite app/Views/errors/html/error_404.php (95%)
 rewrite app/Views/errors/html/error_exception.php (82%)
 rewrite app/Views/errors/html/production.php (84%)
 rewrite app/Views/welcome_message.php (97%)
************************************
*              SUCCESS             *
************************************

Patch successful! Updated files are available on branch tatter/patches.
Deleted branch tatter/scratch (was d16f2e5).
```

Run "composer update":
```console
$ composer update
```

Check the diff:
```console
$ git diff main...tatter/patches
```

### Liaison Revision

#### Example: from v4.1.9 to v4.2.1 by Revision

Commit uncommitted changes in Git:
```console
$ git init
$ git add .
$ git commit -m "CodeIgniter 4.1.9"
```

Install "liaison/revision":
```console
$ composer require --dev liaison/revision
```

Commit uncommitted changes in Git:
```console
$ git add -u
$ git commit -m "add liaison/revision"
```

Run "spark revision:update":
```console
$ php spark revision:update
```

```console
CodeIgniter v4.1.9 Command Line Tool - Server Time: 2022-07-14 18:47:54 UTC-05:00

Liaison Revision
Version: 1.1.0
Run Date: Thu, 14 July 2022, 18:47:54 UTC-05:00

Loaded configuration settings from: Liaison\Revision\Config\Revision.
+---------------------------+--------------------------------------------------------+
| Setting                   | Value                                                  |
+---------------------------+--------------------------------------------------------+
| Root Path                 | /.../ci4app/                                           |
| Write Path                | /.../ci4app/writable/                                  |
| Ignored Directories Count | 0                                                      |
| Ignored Files Count       | 0                                                      |
| Allow Gitignore Entry     | Allowed                                                |
| Fall Through to Project   | Allowed                                                |
| Maximum Retries           | 10                                                     |
| Consolidator              | Liaison\Revision\Consolidation\DefaultConsolidator     |
| Upgrader                  | Liaison\Revision\Upgrade\ComposerUpgrader              |
| Pathfinder                | Liaison\Revision\Paths\DefaultPathfinder               |
| Diff Output Builder       | SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder |
| Log Handlers Count        | 2                                                      |
+---------------------------+--------------------------------------------------------+

Starting software updates...

Loading composer repositories with package information
Updating dependencies
Lock file operations: 0 installs, 1 update, 0 removals
  - Upgrading codeigniter4/framework (v4.1.9 => v4.2.1)
Writing lock file
Installing dependencies from lock file (including require-dev)
Package operations: 0 installs, 1 update, 0 removals
  - Upgrading codeigniter4/framework (v4.1.9 => v4.2.1): Extracting archive
Generating autoload files
32 packages you are using are looking for funding.
Use the `composer fund` command to find out more!
infection/extension-installer: No extensions found

Found 27 files to consolidate.
[p] Proceed.
[l] List all files to consolidate.
[c] List created files only (0).
[m] List modified files only (27).
[d] List deleted files only (0).
[a] Abort.

What shall I do? [p, l, c, m, d, a]: p

Found 1 file in conflict.
[l] List all files in conflict.
[o] Overwrite all.
[b] Create backup files then safely overwrite all.
[s] Skip all.
[r] Resolve each conflict.
[a] Abort.

What shall I do? [l, o, b, s, r, a]: l

+----------------------+----------+------+
| File                 | Status   | Diff |
+----------------------+----------+------+
| app/Config/Paths.php | Modified | 9    |
+----------------------+----------+------+



Found 1 file in conflict.
[l] List all files in conflict.
[o] Overwrite all.
[b] Create backup files then safely overwrite all.
[s] Skip all.
[r] Resolve each conflict.
[a] Abort.

What shall I do? [l, o, b, s, r, a]: r

This file was modified from source and does not match with your file.
app/Config/Paths.php

[d] Display local modifications (diff).
[o] Overwrite file in destination.
[b] Safely overwrite file in destination.
[s] Skip this file.
[a] Abort.

What shall I do? [d, o, b, s, a]: d

Displaying diff for: app/Config/Paths.php
--- Original
+++ New
@@ -25,7 +25,7 @@
      *
      * @var string
      */
-    public $systemDirectory = __DIR__ . '/../../vendor/codeigniter4/framework/system';
+    public $systemDirectory = __DIR__ . '/../../system';
 
     /**
      * ---------------------------------------------------------------

This file was modified from source and does not match with your file.
app/Config/Paths.php

[d] Display local modifications (diff).
[o] Overwrite file in destination.
[b] Safely overwrite file in destination.
[s] Skip this file.
[a] Abort.

What shall I do? [d, o, b, s, a]: s


Logs for this run can be found here:
/.../ci4app/writable/revision/logs/

Terminating: Application update was successful.
Software updates finished in 1.094 minutes.
```

Check the diff:
```console
$ git diff
```

## Upgrading CodeIgniter4 to next version branch

> **Note**
> This requires Unix shell.

Before running this command, you need to commit all the changes:
```console
$ cd /path/to/ci4/project
$ git add -u
$ git commit
```

```console
$ php ci4-update.php <branch>
```

The following command updates CodeIgniter to `4.3` branch:
```console
$ php ci4-update.php 4.3.x-dev
```

This command fails due to a conflict. You need to resolve the conflict and complete git cherry-pick.
