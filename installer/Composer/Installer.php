<?php

namespace extInstaller\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        return 'extended/' . substr($package->getPrettyName(), 7);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'template-extension' === $packageType;
    }
}