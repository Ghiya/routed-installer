# Change Log
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) 
and this project adheres to [Semantic Versioning](http://semver.org/)

## [v1.1.0] - 2018-03-22

## Изменено
- формирование данных установки и обработка всех параметров плагина вынесена в отдельный класс RoutedInstaller
- параметр плагина `path` изменён на `installPath`
- параметр плагина `vendor` изменён на `filterVendor` с изменением типа параметра на `bool`


## [v1.0.0] - 2018-03-21

### Добавлено
- возможность выбора папки для установки и динамической фильтрации производителя пакета в пути установки через дополнительные параметры `extra` в `composer.json`


[Разработка]: https://github.com/Ghiya/routed-installer/v1.1.0...HEAD
[v1.1.0]: https://github.com/Ghiya/routed-installer/compare/v1.1.0...v1.0.0