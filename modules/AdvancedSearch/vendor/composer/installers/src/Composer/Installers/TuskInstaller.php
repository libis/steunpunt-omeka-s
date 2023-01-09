<?php
<<<<<<< HEAD

namespace Composer\Installers;

/**
 * Composer installer for 3rd party Tusk utilities
 * @author Drew Ewing <drew@phenocode.com>
 */
class TuskInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array(
        'task'    => '.tusk/tasks/{$name}/',
        'command' => '.tusk/commands/{$name}/',
        'asset'   => 'assets/tusk/{$name}/',
    );
}
=======
    namespace Composer\Installers;
    /**
     * Composer installer for 3rd party Tusk utilities
     * @author Drew Ewing <drew@phenocode.com>
     */
    class TuskInstaller extends BaseInstaller
    {
        protected $locations = array(
            'task'    => '.tusk/tasks/{$name}/',
            'command' => '.tusk/commands/{$name}/',
            'asset'   => 'assets/tusk/{$name}/',
        );
    }
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
