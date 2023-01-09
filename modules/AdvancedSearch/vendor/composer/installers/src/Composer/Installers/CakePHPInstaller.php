<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

use Composer\DependencyResolver\Pool;
use Composer\Semver\Constraint\Constraint;

class CakePHPInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin' => 'Plugin/{$name}/',
    );

    /**
     * Format package name to CamelCase
     */
<<<<<<< HEAD
    public function inflectPackageVars(array $vars): array
=======
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($this->matchesCakeVersion('>=', '3.0.0')) {
            return $vars;
        }

        $nameParts = explode('/', $vars['name']);
        foreach ($nameParts as &$value) {
<<<<<<< HEAD
            $value = strtolower($this->pregReplace('/(?<=\\w)([A-Z])/', '_\\1', $value));
=======
            $value = strtolower(preg_replace('/(?<=\\w)([A-Z])/', '_\\1', $value));
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
            $value = str_replace(array('-', '_'), ' ', $value);
            $value = str_replace(' ', '', ucwords($value));
        }
        $vars['name'] = implode('/', $nameParts);

        return $vars;
    }

    /**
     * Change the default plugin location when cakephp >= 3.0
     */
<<<<<<< HEAD
    public function getLocations(string $frameworkType): array
=======
    public function getLocations()
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        if ($this->matchesCakeVersion('>=', '3.0.0')) {
            $this->locations['plugin'] =  $this->composer->getConfig()->get('vendor-dir') . '/{$vendor}/{$name}/';
        }
        return $this->locations;
    }

    /**
     * Check if CakePHP version matches against a version
     *
<<<<<<< HEAD
     * @phpstan-param Constraint::STR_OP_* $matcher
     */
    protected function matchesCakeVersion(string $matcher, string $version): bool
    {
        $repositoryManager = $this->composer->getRepositoryManager();
        /** @phpstan-ignore-next-line */
        if (!$repositoryManager) {
=======
     * @param string $matcher
     * @param string $version
     * @return bool
     * @phpstan-param Constraint::STR_OP_* $matcher
     */
    protected function matchesCakeVersion($matcher, $version)
    {
        $repositoryManager = $this->composer->getRepositoryManager();
        if (! $repositoryManager) {
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
            return false;
        }

        $repos = $repositoryManager->getLocalRepository();
<<<<<<< HEAD
        /** @phpstan-ignore-next-line */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
        if (!$repos) {
            return false;
        }

        return $repos->findPackage('cakephp/cakephp', new Constraint($matcher, $version)) !== null;
    }
}
