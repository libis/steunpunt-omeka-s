<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class MediaWikiInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'core' => 'core/',
        'extension' => 'extensions/{$name}/',
        'skin' => 'skins/{$name}/',
    );

    /**
     * Format package name.
     *
     * For package type mediawiki-extension, cut off a trailing '-extension' if present and transform
     * to CamelCase keeping existing uppercase chars.
     *
     * For package type mediawiki-skin, cut off a trailing '-skin' if present.
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
    {
=======
     *
     */
    public function inflectPackageVars($vars)
    {

>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        if ($vars['type'] === 'mediawiki-extension') {
            return $this->inflectExtensionVars($vars);
        }

        if ($vars['type'] === 'mediawiki-skin') {
            return $this->inflectSkinVars($vars);
        }

        return $vars;
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectExtensionVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/-extension$/', '', $vars['name']);
=======
    protected function inflectExtensionVars($vars)
    {
        $vars['name'] = preg_replace('/-extension$/', '', $vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        $vars['name'] = str_replace('-', ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectSkinVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/-skin$/', '', $vars['name']);

        return $vars;
    }
=======
    protected function inflectSkinVars($vars)
    {
        $vars['name'] = preg_replace('/-skin$/', '', $vars['name']);

        return $vars;
    }

>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
}
