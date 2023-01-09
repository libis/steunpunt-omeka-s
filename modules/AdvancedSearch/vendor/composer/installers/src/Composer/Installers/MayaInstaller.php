<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class MayaInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module' => 'modules/{$name}/',
    );

    /**
     * Format package name.
     *
     * For package type maya-module, cut off a trailing '-module' if present.
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     *
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($vars['type'] === 'maya-module') {
            return $this->inflectModuleVars($vars);
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
        $vars['name'] = $this->pregReplace('/-module$/', '', $vars['name']);
=======
    protected function inflectModuleVars($vars)
    {
        $vars['name'] = preg_replace('/-module$/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }
}
