<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

/**
 * An installer to handle MODX Evolution specifics when installing packages.
 */
class MODXEvoInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'snippet'       => 'assets/snippets/{$name}/',
        'plugin'        => 'assets/plugins/{$name}/',
        'module'        => 'assets/modules/{$name}/',
        'template'      => 'assets/templates/{$name}/',
        'lib'           => 'assets/lib/{$name}/'
    );
}
