<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

/**
 * Class PiwikInstaller
 *
 * @package Composer\Installers
 */
class PiwikInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
    /**
     * @var array
     */
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin' => 'plugins/{$name}/',
    );

    /**
     * Format package name to CamelCase
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
    {
        $vars['name'] = strtolower($this->pregReplace('/(?<=\\w)([A-Z])/', '_\\1', $vars['name']));
=======
     * @param array $vars
     *
     * @return array
     */
    public function inflectPackageVars($vars)
    {
        $vars['name'] = strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $vars['name']));
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }
}
