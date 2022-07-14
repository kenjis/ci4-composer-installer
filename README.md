# CodeIgniter4 Composer Installer

You can install previous versions of [CodeIgniter 4 app starter](https://github.com/codeigniter4/appstarter).

> **Warning**
> Many of the older versions of CI4 have active [Security Advisories](https://github.com/codeigniter4/CodeIgniter4/security/advisories). So do not use them in a production environment.

## Usage

```console
$ php ci4-install.php <dir> <version>
```

The following command installs CodeIgniter 4.1.9:
```console
$ php ci4-install.php ci4app 4.1.9
```

## Upgrading CodeIgniter4

If you want to upgrade the older version of CI4 that you installed, you may need to upgrade Project Files (files in other than `system` folder).

You can do it manually according to [Upgrading From a Previous Version](https://codeigniter4.github.io/CodeIgniter4/installation/upgrading.html).

But if you use [tatter/patches](https://github.com/tattersoftware/codeigniter4-patches) or [https://github.com/paulbalandan/liaison-revision](https://github.com/paulbalandan/liaison-revision), it is easier.

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
...
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

What shall I do? [l, o, b, s, r, a]: o


Logs for this run can be found here:
/Users/kenji/tmp/ci4app/writable/revision/logs/

Terminating: Application update was successful.
Software updates finished in 1.097 minutes.
```

Restore `app/Config/Paths.php`:
```console
$ git restore app/Config/Paths.php
```

Check the diff:
```console
$ git diff
```
