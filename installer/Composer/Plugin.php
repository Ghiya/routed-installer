<?php

namespace extInstaller\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Class Plugin
 *
 * @package extInstaller\Composer
 * @author  Ghiya <ghiya@mikadze.me>
 */
class Plugin implements PluginInterface
{


    public function activate(Composer $composer, IOInterface $io)
    {
        $installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }

}