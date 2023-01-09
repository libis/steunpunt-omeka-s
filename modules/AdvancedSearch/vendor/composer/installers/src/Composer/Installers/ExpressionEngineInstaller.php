<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

use Composer\Package\PackageInterface;

class ExpressionEngineInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======

    protected $locations = array();

>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    private $ee2Locations = array(
        'addon'   => 'system/expressionengine/third_party/{$name}/',
        'theme'   => 'themes/third_party/{$name}/',
    );

<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    private $ee3Locations = array(
        'addon'   => 'system/user/addons/{$name}/',
        'theme'   => 'themes/user/{$name}/',
    );

<<<<<<< HEAD
    public function getLocations(string $frameworkType): array
    {
        if ($frameworkType === 'ee2') {
            $this->locations = $this->ee2Locations;
        } else {
            $this->locations = $this->ee3Locations;
        }

        return $this->locations;
=======
    public function getInstallPath(PackageInterface $package, $frameworkType = '')
    {

        $version = "{$frameworkType}Locations";
        $this->locations = $this->$version;

        return parent::getInstallPath($package, $frameworkType);
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    }
}
