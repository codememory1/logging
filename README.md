# Logging

## Установка

```
composer require codememory/logging
```

> При использовании конфигурации Обязательно выполняем следующие команды
* Создание глобальной конфигурации, если ее не существует
    * `php vendor/bin/gc-cdm g-config:init`
* Merge всей конфигурации
    * `php vendor/bin/gc-cdm g-config:merge --all`

Создаем файл конфигурации **logging.yaml** в папке **configs**
Данными именами, можно руководить с помощью глобальной конфигурации **.config/.codememory.json**

## Обзор конфигурации

```yaml
# configs/logging.yaml

logging:
  # Log handlers
  handlers:
    # Handler name to specify in the logger
    defaultStream:
      # Namespace handler
      handler: Codememory\Components\Logging\Handlers\StreamHandler

      # Handler level that will be triggered for loggers with this level
      forLevel: DEBUG

  # Loggers
  loggers:
    # Logger Name
    phpError:
      handlerName: defaultStream # Name of the handler where the logger will be saved
      forRun: true               # Create a logger to run
      message: null              # Mandatory if "forRun" is true
      level: debug               # Mandatory if "forRun" is true
      context: {}                # Data, Mandatory if "forRun" is true
      extra: {}                  # Extra Data, Mandatory if "forRun" is true
      handlerParameters:
        path: "storage/php.log"  # Path if handler "stream"
        key: "redisKey"          # Redis key if handler "redis"
```

> Если указан ключ __forRun__, то достаточно выполнить logger, без вызова level и других данных. Смотрите ниже

## Пример выполнения logger
```php
<?php
use Codememory\Components\Logging\Logging;

require_once 'vendor/autoload.php';

$logging = new Logging();

// Выполнение логгера из конфигурации
$logging->executeLogger('phpError');
```

## Пример создание обработчика и логгера
```php
use Codememory\Components\Logging\Handlers\StreamHandler;
use Codememory\Components\Logging\Logger;

// Добавление обработчика
$logging->addHandler('new-handler', StreamHandler::class, Logger::ERROR);

// Добавление логгера
$logging->addLogger('my-logger', 'new-handler', [
    'path' => 'my-log.log'
])
->error('Сообщение логгера', ['context-data'])
->addExtra(['extra-data']);
```

## Другие методы Logging
* `existLogger(): bool` Проверить существование Logger
    * string **$name**


* `getLogger(): Logger` Возвращает Logger
    * string **$name**


* `existHandler(): bool` Проверить существование обработчика
    * string **$name**


* `getHandler(): HandlerInterface` Возвращает обработчик
    * string **$name**