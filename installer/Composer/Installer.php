<?php

namespace extInstaller\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;

/**
 * Class Installer
 *
 * @package extInstaller\Composer
 * @author  Ghiya <ghiya@mikadze.me>
 */
class Installer extends LibraryInstaller
{


    /**
     * Путь для установки пакета если не переопределён соответствующим параметром `extra`.
     */
    const INSTALL_ROOT_DEFAULT = 'extension';


    /**
     * Значение ключа параметра `extra` определяющего путь для установки пакета.
     */
    const INSTALL_ROOT_OPTION = 'path';


    /**
     * Значение ключа параметра `extra` определяющего производителя плагина для фильтрации в пути установки.
     */
    const VENDOR_OPTION = 'vendor';


    /**
     * Возвращает путь корневого каталога для установки пакета в зависимости от соответствующего `extra` параметра.
     *
     * @param PackageInterface $package
     *
     * @return string
     */
    protected function getPackageInstallRoot(PackageInterface $package)
    {
        $extraData = $package->getExtra();
        return
            !empty($extraData[self::INSTALL_ROOT_OPTION]) ?
                $extraData[self::INSTALL_ROOT_OPTION] : self::INSTALL_ROOT_DEFAULT;
    }


    /**
     * Возвращает фильтрованную часть пути от корневого каталога содержащую название пакета в зависимости от
     * соответствующего `extra` параметра.
     *
     * @param PackageInterface $package
     *
     * @return bool|string
     */
    protected function getPackageSuffix(PackageInterface $package)
    {
        $extraData = $package->getExtra();
        return
            !empty($extraData[self::VENDOR_OPTION]) ?
                preg_replace(
                    "/" . $extraData[self::VENDOR_OPTION] . "\//i",
                    "",
                    $package->getPrettyName()
                ) :
                $package->getPrettyName();

    }


    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        return $this->getPackageInstallRoot($package) . $this->getPackageSuffix($package);
    }


    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'template-extension' === $packageType;
    }
}