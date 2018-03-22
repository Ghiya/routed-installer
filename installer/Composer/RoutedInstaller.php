<?php

namespace routed\Composer;

use Composer\Package\PackageInterface;

/**
 * Class RoutedInstaller
 *
 * Класс маршрутизации установки пакета установки относительно указанных параметров `extra` в `composer.json`.
 *
 * @property string $packageName  read-only оригинальное название пакета
 * @property string $installPath  read-only путь для установки пакета относительно корневого `composer.json`
 * @property bool   $filterVendor read-only если требуется использовать фильтрацию из пути названия производителя
 *
 * @package routed\Composer
 * @author  Ghiya <ghiya@mikadze.me>
 */
class RoutedInstaller
{


    const DEFAULT_INSTALL_PATH = 'vendor';


    private $_params = [];


    /**
     * RoutedInstall constructor.
     *
     * @param PackageInterface $package
     */
    public function __construct(PackageInterface $package)
    {
        $this->_params =
            array_merge(
                $this->_params,
                [
                    'packageName' => $package->getPrettyName()
                ],
                $package->getExtra()
            );
    }


    /**
     * Геттер параметра плагина с указанным названием.
     *
     * @param $name
     *
     * @return null
     */
    public function __get($name)
    {
        return
            isset($this->_params[$name]) ?
                $this->_params[$name] : null;
    }


    /**
     * Сеттер всегда выбросит исключение поскольку все параметры установки являются read-only.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @throws \ErrorException
     */
    public function __set(string $name, mixed $value)
    {
        throw new \ErrorException("Trying to set read-only property `$name`.");
    }


    /**
     * Если существует параметр плагина с указанным названием.
     *
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return !empty($this->_params[$name]);
    }


    /**
     * Возвращает корневой путь установки пакета относительно расположения корневого `composer.json`.
     * По-умолчанию используется стандартное значение `vendor` контанты `DEFAULT_INSTALL_PATH`.
     *
     * @see
     * @return string
     */
    protected function getPackageRootPath()
    {
        return
            !empty($this->rootPath) ?
                $this->rootPath : self::DEFAULT_INSTALL_PATH;
    }


    /**
     * Возвращает относительный путь установки пакета.
     * Если указано в параметрах плагина осуществляя фильтрацию названия производителя из пути.
     *
     * По-умолчанию используется стандартное значение получаемое методом `getPrettyName` устанавливаемого пакета.
     *
     * @return string
     */
    protected function getPackageRelativePath()
    {
        return
            !empty($this->filterVendor) ?
                (string)array_pop(explode("/", $this->packageName)) :
                $this->packageName;

    }


    /**
     * Возвращает маршрутизированный путь установки пакета относительно указанных параметров.
     *
     * @return string
     */
    public function getRoutedInstallPath()
    {
        return $this->getPackageRootPath() . '/' . $this->getPackageRelativePath();
    }

}