<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class SyDESInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module' => 'app/modules/{$name}/',
        'theme'  => 'themes/{$name}/',
    );

    /**
     * Format module name.
     *
     * Strip `sydes-` prefix and a trailing '-theme' or '-module' from package name if present.
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     *
     * {@inerhitDoc}
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($vars['type'] == 'sydes-module') {
            return $this->inflectModuleVars($vars);
        }

        if ($vars['type'] === 'sydes-theme') {
            return $this->inflectThemeVars($vars);
        }

        return $vars;
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    public function inflectModuleVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/(^sydes-|-module$)/i', '', $vars['name']);
=======
    public function inflectModuleVars($vars)
    {
        $vars['name'] = preg_replace('/(^sydes-|-module$)/i', '', $vars['name']);
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
        $vars['name'] = $this->pregReplace('/(^sydes-|-theme$)/', '', $vars['name']);
=======
    protected function inflectThemeVars($vars)
    {
        $vars['name'] = preg_replace('/(^sydes-|-theme$)/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = strtolower($vars['name']);

        return $vars;
    }
}
