# routed-installer
Composer плагин для установки пакетов в указанные папки структуры проекта.

История изменений кода в [CHANGELOG.md](CHANGELOG.md).

## Использование

Для использования при установке требуемого пакета необходимо в параметрах `composer.json` указать корректный тип `type` и подключить плагин.

Опционально используются дополнительные параметры `extra`. 

Пример конфигурации:

```json

{
 "require": {
    "ghiyam/routed-installer": "^1.1.0"
  },
  "type": "routed-installation",
  "extra": {
    "installPath": "<path/to/install>",
    "filterVendor": true,
    "filterProject": true
  }
}

``` 

## Дополнительные параметры

Все дополнительные параметры являются опциональными и `read-only`. При отсутствии параметров плагин устанавливает пакет согласно стандартным правилам Composer.

- `installPath` : ( по-умолчанию - `vendor` ) строковое значение пути для установки пакета относительно корневого `composer.json`
- `filterVendor` : ( по-умолчанию - `false` ) логическое значение указывающее на необходимость сохранения или фильтрации из пути установки названия производителя пакета 
- `filterPackage` : ( по-умолчанию - `false` ) логическое значение указывающее на необходимость сохранения или фильтрации из пути установки названия проекта пакета

> Tip: В том случае если `filterVendor` и `filterProject` равны `true` пакет будет установлен относительно пути определённом в `installPath`. 
