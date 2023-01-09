<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class RoundcubeInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin' => 'plugins/{$name}/',
    );

    /**
     * Lowercase name and changes the name to a underscores
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     *
     * @param  array $vars
     * @return array
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $vars['name'] = strtolower(str_replace('-', '_', $vars['name']));

        return $vars;
    }
}
