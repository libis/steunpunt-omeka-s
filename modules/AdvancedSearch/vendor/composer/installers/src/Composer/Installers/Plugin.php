<?php

namespace Composer\Installers;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
<<<<<<< HEAD
    /** @var Installer */
    private $installer;

    public function activate(Composer $composer, IOInterface $io): void
=======
    private $installer;

    public function activate(Composer $composer, IOInterface $io)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $this->installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($this->installer);
    }

<<<<<<< HEAD
    public function deactivate(Composer $composer, IOInterface $io): void
=======
    public function deactivate(Composer $composer, IOInterface $io)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
        $composer->getInstallationManager()->removeInstaller($this->installer);
    }

<<<<<<< HEAD
    public function uninstall(Composer $composer, IOInterface $io): void
=======
    public function uninstall(Composer $composer, IOInterface $io)
>>>>>>> c6f1c16375a005bfd976d7028b85168df30fcd28
    {
    }
}
