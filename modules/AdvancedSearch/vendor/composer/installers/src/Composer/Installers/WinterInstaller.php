<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class WinterInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module'    => 'modules/{$name}/',
        'plugin'    => 'plugins/{$vendor}/{$name}/',
        'theme'     => 'themes/{$name}/'
    );

    /**
     * Format package name.
     *
     * For package type winter-plugin, cut off a trailing '-plugin' if present.
     *
     * For package type winter-theme, cut off a trailing '-theme' if present.
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     *
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($vars['type'] === 'winter-module') {
            return $this->inflectModuleVars($vars);
        }
        
        if ($vars['type'] === 'winter-plugin') {
            return $this->inflectPluginVars($vars);
        }

        if ($vars['type'] === 'winter-theme') {
            return $this->inflectThemeVars($vars);
        }

        return $vars;
    }
    
<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectModuleVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/^wn-|-module$/', '', $vars['name']);
=======
    protected function inflectModuleVars($vars)
    {
        $vars['name'] = preg_replace('/^wn-|-module$/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28

        return $vars;
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectPluginVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/^wn-|-plugin$/', '', $vars['name']);
        $vars['vendor'] = $this->pregReplace('/[^a-z0-9_]/i', '', $vars['vendor']);
=======
    protected function inflectPluginVars($vars)
    {
        $vars['name'] = preg_replace('/^wn-|-plugin$/', '', $vars['name']);
        $vars['vendor'] = preg_replace('/[^a-z0-9_]/i', '', $vars['vendor']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28

        return $vars;
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectThemeVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/^wn-|-theme$/', '', $vars['name']);
=======
    protected function inflectThemeVars($vars)
    {
        $vars['name'] = preg_replace('/^wn-|-theme$/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28

        return $vars;
    }
}
