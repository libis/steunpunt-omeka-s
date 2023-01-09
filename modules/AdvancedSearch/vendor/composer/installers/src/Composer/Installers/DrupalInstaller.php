<?php
<<<<<<< HEAD

=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
namespace Composer\Installers;

class DrupalInstaller extends BaseInstaller
{
<<<<<<< HEAD
    /** @var array<string, string> */
=======
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'core'             => 'core/',
        'module'           => 'modules/{$name}/',
        'theme'            => 'themes/{$name}/',
        'library'          => 'libraries/{$name}/',
        'profile'          => 'profiles/{$name}/',
        'database-driver'  => 'drivers/lib/Drupal/Driver/Database/{$name}/',
        'drush'            => 'drush/{$name}/',
        'custom-theme'     => 'themes/custom/{$name}/',
        'custom-module'    => 'modules/custom/{$name}/',
        'custom-profile'   => 'profiles/custom/{$name}/',
        'drupal-multisite' => 'sites/{$name}/',
        'console'          => 'console/{$name}/',
        'console-language' => 'console/language/{$name}/',
        'config'           => 'config/sync/',
    );
}
