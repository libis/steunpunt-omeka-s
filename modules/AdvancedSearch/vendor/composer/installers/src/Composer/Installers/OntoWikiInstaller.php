<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class OntoWikiInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'extension' => 'extensions/{$name}/',
        'theme' => 'extensions/themes/{$name}/',
        'translation' => 'extensions/translations/{$name}/',
    );

    /**
     * Format package name to lower case and remove ".ontowiki" suffix
     */
<<<<<<< HEAD
    public function inflectPackageVars(array $vars): array
    {
        $vars['name'] = strtolower($vars['name']);
        $vars['name'] = $this->pregReplace('/.ontowiki$/', '', $vars['name']);
        $vars['name'] = $this->pregReplace('/-theme$/', '', $vars['name']);
        $vars['name'] = $this->pregReplace('/-translation$/', '', $vars['name']);
=======
    public function inflectPackageVars($vars)
    {
        $vars['name'] = strtolower($vars['name']);
        $vars['name'] = preg_replace('/.ontowiki$/', '', $vars['name']);
        $vars['name'] = preg_replace('/-theme$/', '', $vars['name']);
        $vars['name'] = preg_replace('/-translation$/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28

        return $vars;
    }
}
