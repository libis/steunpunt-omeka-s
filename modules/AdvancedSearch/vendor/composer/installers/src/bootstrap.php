<?php
<<<<<<< HEAD

use Composer\Autoload\ClassLoader;

function includeIfExists(string $file): ?ClassLoader
=======
function includeIfExists($file)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
{
    if (file_exists($file)) {
        return include $file;
    }
<<<<<<< HEAD

    return null;
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
}
if ((!$loader = includeIfExists(__DIR__ . '/../vendor/autoload.php')) && (!$loader = includeIfExists(__DIR__ . '/../../../autoload.php'))) {
    die('You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL);
}
return $loader;
