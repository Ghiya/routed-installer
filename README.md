# routed-installer
Composer плагин для установки расширений шаблонов веб-проектов.

История изменений кода в [CHANGELOG.md](CHANGELOG.md).

## Параметры плагина

> Note: Все параметры `extra` являются опциональными и read-only. Без указания дополнительных параметров плагин устанавливает пакет по стандартным правилам Composer.

|параметр|тип|описание|
|--------|---|--------|
|`installPath`|string|путь для установки пакета относительно корневого `composer.json`|
|`filterVendor`|bool|если требуется использовать фильтрацию из пути названия производителя|

## Пример использования

```json

{
 "require": {
    "ghiyam/routed-installer": "~1.1.0"
  },
  "extra": {
    "installPath": "<relative/path/to/install>",
    "filterVendor": true
  }
}

```