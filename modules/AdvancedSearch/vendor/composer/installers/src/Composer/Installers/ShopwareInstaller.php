<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

/**
 * Plugin/theme installer for shopware
 * @author Benjamin Boit
 */
class ShopwareInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'backend-plugin'    => 'engine/Shopware/Plugins/Local/Backend/{$name}/',
        'core-plugin'       => 'engine/Shopware/Plugins/Local/Core/{$name}/',
        'frontend-plugin'   => 'engine/Shopware/Plugins/Local/Frontend/{$name}/',
        'theme'             => 'templates/{$name}/',
        'plugin'            => 'custom/plugins/{$name}/',
        'frontend-theme'    => 'themes/Frontend/{$name}/',
    );

    /**
     * Transforms the names
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     * @param  array $vars
     * @return array
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($vars['type'] === 'shopware-theme') {
            return $this->correctThemeName($vars);
        }

<<<<<<< HEAD
        return $this->correctPluginName($vars);
=======
        return $this->correctPluginName($vars);        
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    }

    /**
     * Changes the name to a camelcased combination of vendor and name
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
        $vars['name'] = ucfirst($vars['vendor']) . ucfirst($camelCasedName);

        return $vars;
    }

    /**
     * Changes the name to a underscore separated name
<<<<<<< HEAD
     *
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    private function correctThemeName(array $vars): array
=======
     * @param  array $vars
     * @return array
     */
    private function correctThemeName($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $vars['name'] = str_replace('-', '_', $vars['name']);

        return $vars;
    }
}
