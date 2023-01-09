<?php

namespace Composer\Installers;

class SiteDirectInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'module' => 'modules/{$vendor}/{$name}/',
        'plugin' => 'plugins/{$vendor}/{$name}/'
    );

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    public function inflectPackageVars(array $vars): array
=======
    public function inflectPackageVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        return $this->parseVars($vars);
    }

<<<<<<< HEAD
    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function parseVars(array $vars): array
=======
    protected function parseVars($vars)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $vars['vendor'] = strtolower($vars['vendor']) == 'sitedirect' ? 'SiteDirect' : $vars['vendor'];
        $vars['name'] = str_replace(array('-', '_'), ' ', $vars['name']);
        $vars['name'] = str_replace(' ', '', ucwords($vars['name']));

        return $vars;
    }
}
