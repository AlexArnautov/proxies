## Инструкция по установке
1) Клонировать репозиторий и перейти в директорию proxies
2) Запустить скрипт up.sh (. up.sh)
Скрипт может спросить sudo пароль для установки прав на директорию storage.

Скрипт задеплоит приложение на localhost и выполнит все тесты.
Также можно добавить строку 127.0.0.1 laravel.local в hosts файл в вашей ОС.
Приложение станет доступно по адресу laravel.local

## Использованные сторонние библиотеки
1) https://laravel-excel.com/
2) https://jwt-auth.readthedocs.io/en/develop/

## Подключение новго провайдера прокси
1) Создать новый класс провайдера по аналогии с
app/Services/RandomProxyProvider.php который реализует ProxyProviderInterface.php интерфейс.
2) Создать репозиторий для этого провайдера (пример app/Repositories/RandomProxyRepository.php)
3) В файле сервис-провайдера app/Providers/ProxyServiceProvider.php добавить биндинг нового интерфейса 
для созданного репозитория.

Таким образом можно одновременно пользоваться различными источниками прокси серверов просто
подключая нужные репозитории через Dependency Injection.

Также в корне проекта лежит Postman коллекция для тестов. (использует laravel.local URL)
FileName: laravel.postman_collection.json
