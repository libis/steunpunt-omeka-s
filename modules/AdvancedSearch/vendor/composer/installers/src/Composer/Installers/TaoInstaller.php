<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

/**
 * An installer to handle TAO extensions.
 */
class TaoInstaller extends BaseInstaller
{
    const EXTRA_TAO_EXTENSION_NAME = 'tao-extension-name';

<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'extension' => '{$name}'
    );
    
<<<<<<< HEAD
    public function inflectPackageVars(array $vars): array
=======
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $extra = $this->package->getExtra();

        if (array_key_exists(self::EXTRA_TAO_EXTENSION_NAME, $extra)) {
            $vars['name'] = $extra[self::EXTRA_TAO_EXTENSION_NAME];
            return $vars;
        }

        $vars['name'] = str_replace('extension-', '', $vars['name']);
        $vars['name'] = str_replace('-', ' ', $vars['name']);
        $vars['name'] = lcfirst(str_replace(' ', '', ucwords($vars['name'])));

        return $vars;
    }
}
