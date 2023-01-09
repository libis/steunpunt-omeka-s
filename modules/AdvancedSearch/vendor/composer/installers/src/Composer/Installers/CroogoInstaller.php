<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class CroogoInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin' => 'Plugin/{$name}/',
        'theme' => 'View/Themed/{$name}/',
    );

    /**
     * Format package name to CamelCase
     */
<<<<<<< HEAD
    public function inflectPackageVars(array $vars): array
=======
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $vars['name'] = strtolower(str_replace(array('-', '_'), ' ', $vars['name']));
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }
}
