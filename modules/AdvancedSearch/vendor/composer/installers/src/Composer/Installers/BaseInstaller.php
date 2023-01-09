<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

use Composer\IO\IOInterface;
use Composer\Composer;
use Composer\Package\PackageInterface;

abstract class BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
    protected $locations = array();
    /** @var Composer */
    protected $composer;
    /** @var PackageInterface */
    protected $package;
    /** @var IOInterface */
=======
    protected $locations = array();
    protected $composer;
    protected $package;
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $io;

    /**
     * Initializes base installer.
<<<<<<< HEAD
     */
    public function __construct(PackageInterface $package, Composer $composer, IOInterface $io)
=======
     *
     * @param PackageInterface $package
     * @param Composer         $composer
     * @param IOInterface      $io
     */
    public function __construct(PackageInterface $package = null, Composer $composer = null, IOInterface $io = null)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $this->composer = $composer;
        $this->package = $package;
        $this->io = $io;
    }

    /**
     * Return the install path based on package type.
<<<<<<< HEAD
     */
    public function getInstallPath(PackageInterface $package, string $frameworkType = ''): string
=======
     *
     * @param  PackageInterface $package
     * @param  string           $frameworkType
     * @return string
     */
    public function getInstallPath(PackageInterface $package, $frameworkType = '')
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $type = $this->package->getType();

        $prettyName = $this->package->getPrettyName();
        if (strpos($prettyName, '/') !== false) {
            list($vendor, $name) = explode('/', $prettyName);
        } else {
            $vendor = '';
            $name = $prettyName;
        }

        $availableVars = $this->inflectPackageVars(compact('name', 'vendor', 'type'));

        $extra = $package->getExtra();
        if (!empty($extra['installer-name'])) {
            $availableVars['name'] = $extra['installer-name'];
        }

<<<<<<< HEAD
        $extra = $this->composer->getPackage()->getExtra();
        if (!empty($extra['installer-paths'])) {
            $customPath = $this->mapCustomInstallPaths($extra['installer-paths'], $prettyName, $type, $vendor);
            if ($customPath !== false) {
                return $this->templatePath($customPath, $availableVars);
=======
        if ($this->composer->getPackage()) {
            $extra = $this->composer->getPackage()->getExtra();
            if (!empty($extra['installer-paths'])) {
                $customPath = $this->mapCustomInstallPaths($extra['installer-paths'], $prettyName, $type, $vendor);
                if ($customPath !== false) {
                    return $this->templatePath($customPath, $availableVars);
                }
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
            }
        }

        $packageType = substr($type, strlen($frameworkType) + 1);
<<<<<<< HEAD
        $locations = $this->getLocations($frameworkType);
=======
        $locations = $this->getLocations();
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        if (!isset($locations[$packageType])) {
            throw new \InvalidArgumentException(sprintf('Package type "%s" is not supported', $type));
        }

        return $this->templatePath($locations[$packageType], $availableVars);
    }

    /**
     * For an installer to override to modify the vars per installer.
     *
     * @param  array<string, string> $vars This will normally receive array{name: string, vendor: string, type: string}
     * @return array<string, string>
     */
<<<<<<< HEAD
    public function inflectPackageVars(array $vars): array
=======
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        return $vars;
    }

    /**
     * Gets the installer's locations
     *
     * @return array<string, string> map of package types => install path
     */
<<<<<<< HEAD
    public function getLocations(string $frameworkType)
=======
    public function getLocations()
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        return $this->locations;
    }

    /**
     * Replace vars in a path
     *
<<<<<<< HEAD
     * @param  array<string, string> $vars
     */
    protected function templatePath(string $path, array $vars = array()): string
=======
     * @param  string                $path
     * @param  array<string, string> $vars
     * @return string
     */
    protected function templatePath($path, array $vars = array())
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if (strpos($path, '{') !== false) {
            extract($vars);
            preg_match_all('@\{\$([A-Za-z0-9_]*)\}@i', $path, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $var) {
                    $path = str_replace('{$' . $var . '}', $$var, $path);
                }
            }
        }

        return $path;
    }

    /**
     * Search through a passed paths array for a custom install path.
     *
<<<<<<< HEAD
     * @param  array<string, string[]|string> $paths
     * @return string|false
     */
    protected function mapCustomInstallPaths(array $paths, string $name, string $type, ?string $vendor = null)
=======
     * @param  array  $paths
     * @param  string $name
     * @param  string $type
     * @param  string $vendor = NULL
     * @return string|false
     */
    protected function mapCustomInstallPaths(array $paths, $name, $type, $vendor = NULL)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        foreach ($paths as $path => $names) {
            $names = (array) $names;
            if (in_array($name, $names) || in_array('type:' . $type, $names) || in_array('vendor:' . $vendor, $names)) {
                return $path;
            }
        }

        return false;
    }
<<<<<<< HEAD

    protected function pregReplace(string $pattern, string $replacement, string $subject): string
    {
        $result = preg_replace($pattern, $replacement, $subject);
        if (null === $result) {
            throw new \RuntimeException('Failed to run preg_replace with '.$pattern.': '.preg_last_error());
        }

        return $result;
    }
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
}
