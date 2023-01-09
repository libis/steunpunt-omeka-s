<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

/**
 * Plugin/theme installer for majima
 * @author David Neustadt
 */
class MajimaInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin' => 'plugins/{$name}/',
    );

    /**
     * Transforms the names
<<<<<<< HEAD
     *
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    public function inflectPackageVars(array $vars): array
=======
     * @param  array $vars
     * @return array
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        return $this->correctPluginName($vars);
    }

    /**
     * Change hyphenated names to camelcase
<<<<<<< HEAD
     *
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    private function correctPluginName(array $vars): array
=======
     * @param  array $vars
     * @return array
     */
    private function correctPluginName($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $camelCasedName = preg_replace_callback('/(-[a-z])/', function ($matches) {
            return strtoupper($matches[0][1]);
        }, $vars['name']);
<<<<<<< HEAD

        if (null === $camelCasedName) {
            throw new \RuntimeException('Failed to run preg_replace_callback: '.preg_last_error());
        }

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = ucfirst($camelCasedName);
        return $vars;
    }
}
