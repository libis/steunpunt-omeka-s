<?php
<<<<<<< HEAD

namespace Composer\Installers;

class YawikInstaller extends BaseInstaller
{
    /** @var array<string, string> */
=======
/**
 * Created by PhpStorm.
 * User: cbleek
 * Date: 25.03.16
 * Time: 20:55
 */

namespace Composer\Installers;


class YawikInstaller extends BaseInstaller
{
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module'  => 'module/{$name}/',
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
<<<<<<< HEAD
}
=======
}
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
