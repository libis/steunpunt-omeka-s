<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

use Composer\Package\PackageInterface;

class MauticInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin'           => 'plugins/{$name}/',
        'theme'            => 'themes/{$name}/',
        'core'             => 'app/',
    );

<<<<<<< HEAD
    private function getDirectoryName(): string
=======
    private function getDirectoryName()
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $extra = $this->package->getExtra();
        if (!empty($extra['install-directory-name'])) {
            return $extra['install-directory-name'];
        }

        return $this->toCamelCase($this->package->getPrettyName());
    }

<<<<<<< HEAD
    private function toCamelCase(string $packageName): string
=======
    /**
     * @param string $packageName
     *
     * @return string
     */
    private function toCamelCase($packageName)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', basename($packageName))));
    }

    /**
     * Format package name of mautic-plugins to CamelCase
     */
<<<<<<< HEAD
    public function inflectPackageVars(array $vars): array
    {
=======
    public function inflectPackageVars($vars)
    {

>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        if ($vars['type'] == 'mautic-plugin' || $vars['type'] == 'mautic-theme') {
            $directoryName = $this->getDirectoryName();
            $vars['name'] = $directoryName;
        }

        return $vars;
    }
<<<<<<< HEAD
=======

>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
}
