<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class DokuWikiInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin' => 'lib/plugins/{$name}/',
        'template' => 'lib/tpl/{$name}/',
    );

    /**
     * Format package name.
     *
<<<<<<< HEAD
     * For package type dokuwiki-plugin, cut off a trailing '-plugin',
     * or leading dokuwiki_ if present.
     *
     * For package type dokuwiki-template, cut off a trailing '-template' if present.
     */
    public function inflectPackageVars(array $vars): array
    {
=======
     * For package type dokuwiki-plugin, cut off a trailing '-plugin', 
     * or leading dokuwiki_ if present.
     * 
     * For package type dokuwiki-template, cut off a trailing '-template' if present.
     *
     */
    public function inflectPackageVars($vars)
    {

>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        if ($vars['type'] === 'dokuwiki-plugin') {
            return $this->inflectPluginVars($vars);
        }

        if ($vars['type'] === 'dokuwiki-template') {
            return $this->inflectTemplateVars($vars);
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
        $vars['name'] = $this->pregReplace('/-plugin$/', '', $vars['name']);
        $vars['name'] = $this->pregReplace('/^dokuwiki_?-?/', '', $vars['name']);
=======
    protected function inflectPluginVars($vars)
    {
        $vars['name'] = preg_replace('/-plugin$/', '', $vars['name']);
        $vars['name'] = preg_replace('/^dokuwiki_?-?/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28

        return $vars;
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectTemplateVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/-template$/', '', $vars['name']);
        $vars['name'] = $this->pregReplace('/^dokuwiki_?-?/', '', $vars['name']);

        return $vars;
    }
=======
    protected function inflectTemplateVars($vars)
    {
        $vars['name'] = preg_replace('/-template$/', '', $vars['name']);
        $vars['name'] = preg_replace('/^dokuwiki_?-?/', '', $vars['name']);

        return $vars;
    }

>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
}
