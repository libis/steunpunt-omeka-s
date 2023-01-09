<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class AsgardInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module' => 'Modules/{$name}/',
        'theme' => 'Themes/{$name}/'
    );

    /**
     * Format package name.
     *
     * For package type asgard-module, cut off a trailing '-plugin' if present.
     *
     * For package type asgard-theme, cut off a trailing '-theme' if present.
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     *
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($vars['type'] === 'asgard-module') {
            return $this->inflectPluginVars($vars);
        }

        if ($vars['type'] === 'asgard-theme') {
            return $this->inflectThemeVars($vars);
        }

        return $vars;
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectPluginVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/-module$/', '', $vars['name']);
=======
    protected function inflectPluginVars($vars)
    {
        $vars['name'] = preg_replace('/-module$/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectThemeVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/-theme$/', '', $vars['name']);
=======
    protected function inflectThemeVars($vars)
    {
        $vars['name'] = preg_replace('/-theme$/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }
}
