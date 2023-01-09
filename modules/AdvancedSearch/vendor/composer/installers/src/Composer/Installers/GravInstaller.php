<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class GravInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin' => 'user/plugins/{$name}/',
        'theme'  => 'user/themes/{$name}/',
    );

    /**
     * Format package name
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     *
     * @param array $vars
     *
     * @return array
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $restrictedWords = implode('|', array_keys($this->locations));

        $vars['name'] = strtolower($vars['name']);
<<<<<<< HEAD
        $vars['name'] = $this->pregReplace(
            '/^(?:grav-)?(?:(?:'.$restrictedWords.')-)?(.*?)(?:-(?:'.$restrictedWords.'))?$/ui',
=======
        $vars['name'] = preg_replace('/^(?:grav-)?(?:(?:'.$restrictedWords.')-)?(.*?)(?:-(?:'.$restrictedWords.'))?$/ui',
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
            '$1',
            $vars['name']
        );

        return $vars;
    }
}
