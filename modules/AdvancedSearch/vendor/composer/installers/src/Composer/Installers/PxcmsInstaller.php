<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class PxcmsInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module' => 'app/Modules/{$name}/',
        'theme' => 'themes/{$name}/',
    );

    /**
     * Format package name.
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
=======
     *
     * @param array $vars
     *
     * @return array
     */
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($vars['type'] === 'pxcms-module') {
            return $this->inflectModuleVars($vars);
        }

        if ($vars['type'] === 'pxcms-theme') {
            return $this->inflectThemeVars($vars);
        }

        return $vars;
    }

    /**
     * For package type pxcms-module, cut off a trailing '-plugin' if present.
     *
<<<<<<< HEAD
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectModuleVars(array $vars): array
    {
        $vars['name'] = str_replace('pxcms-', '', $vars['name']);       // strip out pxcms- just incase (legacy)
        $vars['name'] = str_replace('module-', '', $vars['name']);      // strip out module-
        $vars['name'] = $this->pregReplace('/-module$/', '', $vars['name']);  // strip out -module
=======
     * return string
     */
    protected function inflectModuleVars($vars)
    {
        $vars['name'] = str_replace('pxcms-', '', $vars['name']);       // strip out pxcms- just incase (legacy)
        $vars['name'] = str_replace('module-', '', $vars['name']);      // strip out module-
        $vars['name'] = preg_replace('/-module$/', '', $vars['name']);  // strip out -module
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = str_replace('-', '_', $vars['name']);           // make -'s be _'s
        $vars['name'] = ucwords($vars['name']);                         // make module name camelcased

        return $vars;
    }

<<<<<<< HEAD
    /**
     * For package type pxcms-module, cut off a trailing '-plugin' if present.
     *
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectThemeVars(array $vars): array
    {
        $vars['name'] = str_replace('pxcms-', '', $vars['name']);       // strip out pxcms- just incase (legacy)
        $vars['name'] = str_replace('theme-', '', $vars['name']);       // strip out theme-
        $vars['name'] = $this->pregReplace('/-theme$/', '', $vars['name']);   // strip out -theme
=======

    /**
     * For package type pxcms-module, cut off a trailing '-plugin' if present.
     *
     * return string
     */
    protected function inflectThemeVars($vars)
    {
        $vars['name'] = str_replace('pxcms-', '', $vars['name']);       // strip out pxcms- just incase (legacy)
        $vars['name'] = str_replace('theme-', '', $vars['name']);       // strip out theme-
        $vars['name'] = preg_replace('/-theme$/', '', $vars['name']);   // strip out -theme
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = str_replace('-', '_', $vars['name']);           // make -'s be _'s
        $vars['name'] = ucwords($vars['name']);                         // make module name camelcased

        return $vars;
    }
}
