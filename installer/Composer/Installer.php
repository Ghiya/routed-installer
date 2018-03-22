<?php

namespace routed\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Class Installer
 *
 * @package routed\Composer
 *
 * @author  Ghiya <ghiya@mikadze.me>
 * @see     RoutedInstaller класс маршрутизируемой установки пакета
 */
class Installer extends LibraryInstaller
{


    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        return (new RoutedInstaller($package))->getRoutedInstallPath();
    }


    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'template-extension' === $packageType;
    }
}