<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class AglInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module' => 'More/{$name}/',
    );

    /**
     * Format package name to CamelCase
     */
<<<<<<< HEAD
    public function inflectPackageVars(array $vars): array
    {
        $name = preg_replace_callback('/(?:^|_|-)(.?)/', function ($matches) {
            return strtoupper($matches[1]);
        }, $vars['name']);

        if (null === $name) {
            throw new \RuntimeException('Failed to run preg_replace_callback: '.preg_last_error());
        }

        $vars['name'] = $name;

=======
    public function inflectPackageVars($vars)
    {
        $vars['name'] = preg_replace_callback('/(?:^|_|-)(.?)/', function ($matches) {
            return strtoupper($matches[1]);
        }, $vars['name']);

>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        return $vars;
    }
}
