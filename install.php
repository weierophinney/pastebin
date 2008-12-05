<?php
define('APPLICATION_ENV', 'development');
$cwd   = realpath(dirname(__FILE__));
$zfdir = null;
if (1 < $argc) {
    $arg0 = $argv[1];
    if (in_array($arg0, array('-h', '--help', '-?'))) {
        help();
        exit;
    }

    $zfdir = $argv[1];
}

echo "Creating required symlinks...\n";
createLink($cwd . '/public/js-src', $cwd . '/public/js');
if ($zfdir) {
    createLink($zfdir, $cwd . '/library/Zend');
}
echo "[DONE] Creating required symlinks\n\n";

echo "Creating initial database...\n";
include $cwd . '/scripts/loadTestDb.php';
echo "[DONE] Creating initial database\n\n";

echo "Setting permissions...\n";
dirSetPerms($cwd . '/data', 0777);
dirSetPerms($cwd . '/public/api/spindle/paste/content', 0777);
echo "[DONE] Setting permissions\n\n";

// Done
echo <<<EOM
Thank you for trying this application. To use it, please make sure you have 
setup an apache vhost (or similar functionality on other web servers) according 
to the instructions in the README.txt file.
EOM;

function help()
{
    echo<<<EOM
install.php - setup Spindle application
Sets up the Spindle application by creating appropriate symlinks, setting 
appropriate permissions for data directories, and preparing the initial 
database.

Arguments:
    -h, --help, -?: Print this message
    path          : Path to Zend framework 'library/Zend' directory; this will 
                    be symlinked into library/Zend

Example:
    % php install.php /opt/ZendFramework/library/Zend

EOM;
}

function dirSetPerms($target, $perms) 
{
    echo "    Setting permissions for $target to $perms...\n";
    chmod($target, $perms);
    $iterator = new RecursiveDirectoryIterator($target);
    foreach (new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST) as $file) {
        $name = $file->getPathName();
        echo "        Updating $name\n";
        chmod($file->getPathName(), $perms);
    }
    echo "    [DONE] Setting permissions for $target to $perms\n";
}

function createLink($target, $name)
{
    echo "    Linking $name to $target... ";

    if (file_exists($name)) {
        echo "link already exists; [DONE]\n";
        return;
    }

    if (strtolower(substr(PHP_OS, 0, 3)) == 'win') {
        if (strstr($target, 'js-src')) {
            rename($target, $name);
        } else {
            echo "Cannot create symlinks on Windows; you will manually need to do this\n";
            return;
        }
    } else {
        symlink($target, $name);
    }

    echo "[DONE]\n";
}
