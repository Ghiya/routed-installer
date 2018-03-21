# template-extension-installer
Composer плагин для установки расширений шаблонов веб-проектов.

История изменений кода в [CHANGELOG.md](CHANGELOG.md).

## Пример использования

```json

{

 "require": {
    "ghiyam/template-extension-installer": "~1.0.0"
  },
  "extra": {
    "path": "<root_installation_folder>",
    "vendor": "<vendor_name_to_fliter_from_installation_path>"
  }
}

```

> Note: Параметры `extra` являются опциональными. По-умолчанию расширения устанавливаются в папку `extensions/<package_pretty_name>`