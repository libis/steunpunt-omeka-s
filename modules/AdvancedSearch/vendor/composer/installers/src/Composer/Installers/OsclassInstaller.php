<?php
<<<<<<< HEAD

namespace Composer\Installers;

class OsclassInstaller extends BaseInstaller
{
    
    /** @var array<string, string> */
=======
namespace Composer\Installers;


class OsclassInstaller extends BaseInstaller 
{
    
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    protected $locations = array(
        'plugin' => 'oc-content/plugins/{$name}/',
        'theme' => 'oc-content/themes/{$name}/',
        'language' => 'oc-content/languages/{$name}/',
    );
<<<<<<< HEAD
=======
    
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
}
