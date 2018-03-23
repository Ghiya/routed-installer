<?php

namespace routed\Composer;

use Composer\Package\PackageInterface;

/**
 * Class RoutedInstaller
 *
 * Класс маршрутизации установки пакета установки относительно указанных параметров `extra` в `composer.json`.
 *
 * @property string $packageName   read-only оригинальное название пакета
 * @property string $installPath   read-only путь для установки пакета относительно корневого `composer.json`
 * @property bool   $filterVendor  read-only если требуется использовать фильтрацию из пути названия производителя
 * @property bool   $filterProject read-only если требуется использовать фильтрацию из пути названия проекта
 *
 * @package routed\Composer
 * @author  Ghiya <ghiya@mikadze.me>
 */
class RoutedInstaller
{


    /**
     * Значение пути установки пакета относительно корневого `composer.json` используемое по-умолчанию.
     */
    const DEFAULT_INSTALL_PATH = 'vendor';


    /**
     * @var array параметры установки
     */
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
     * @throws \Exception always
     */
    public function __set(string $name, mixed $value)
    {
        throw new \Exception("Plugin properties are read-only.");
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
        return isset($this->_params[$name]);
    }


    /**
     * Возвращает корневой путь установки пакета относительно расположения корневого `composer.json`.
     * По-умолчанию используется стандартное значение `vendor` контанты `DEFAULT_INSTALL_PATH`.
     *
     * @return string
     */
    protected function getInstallPathRoot()
    {
        return
            isset($this->installPath) ?
                $this->installPath . "/" : self::DEFAULT_INSTALL_PATH;
    }


    /**
     * Возвращает путь установки пакета относительно корневого пути.
     * Если указано в параметрах плагина осуществляет фильтрацию названия производителя/названия проекта из пути.
     * По-умолчанию используется стандартное значение получаемое методом `getPrettyName` устанавливаемого пакета.
     *
     * @return string
     */
    protected function getInstallPathRelative()
    {
        $packageNameList = explode("/", $this->packageName);
        return
            empty($this->filterVendor) ?
                empty($this->filterProject) ?
                    $this->packageName : // should not filter anything
                    (string)array_shift($packageNameList) : // should filter project but vendor
                empty($this->filterProject) ?
                    (string)end($packageNameList) : // should filter vendor but project
                    ""; // should filter both vendor and project
    }


    /**
     * Возвращает маршрутизированный путь установки пакета относительно указанных параметров.
     *
     * @return string
     */
    public function getRoutedInstallPath()
    {
        return $this->getInstallPathRoot() . $this->getInstallPathRelative();
    }

}