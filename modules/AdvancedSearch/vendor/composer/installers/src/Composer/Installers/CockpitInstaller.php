<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class CockpitInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module' => 'cockpit/modules/addons/{$name}/',
    );

    /**
     * Format module name.
     *
     * Strip `module-` prefix from package name.
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     *
     * {@inheritDoc}
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($vars['type'] == 'cockpit-module') {
            return $this->inflectModuleVars($vars);
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
        $vars['name'] = ucfirst($this->pregReplace('/cockpit-/i', '', $vars['name']));
=======
    public function inflectModuleVars($vars)
    {
        $vars['name'] = ucfirst(preg_replace('/cockpit-/i', '', $vars['name']));
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28

        return $vars;
    }
}
