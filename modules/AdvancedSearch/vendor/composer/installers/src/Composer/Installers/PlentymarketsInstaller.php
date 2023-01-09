<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class PlentymarketsInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin'   => '{$name}/'
    );

    /**
     * Remove hyphen, "plugin" and format to camelcase
<<<<<<< HEAD
     */
    public function inflectPackageVars(array $vars): array
    {
        $nameBits = explode("-", $vars['name']);
        foreach ($nameBits as $key => $name) {
            $nameBits[$key] = ucfirst($name);
            if (strcasecmp($name, "Plugin") == 0) {
                unset($nameBits[$key]);
            }
        }
        $vars['name'] = implode('', $nameBits);
=======
     * @param array $vars
     *
     * @return array
     */
    public function inflectPackageVars($vars)
    {
        $vars['name'] = explode("-", $vars['name']);
        foreach ($vars['name'] as $key => $name) {
            $vars['name'][$key] = ucfirst($vars['name'][$key]);
            if (strcasecmp($name, "Plugin") == 0) {
                unset($vars['name'][$key]);
            }
        }
        $vars['name'] = implode("",$vars['name']);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28

        return $vars;
    }
}
