# dumper

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->


- [Установка](#%D1%83%D1%81%D1%82%D0%B0%D0%BD%D0%BE%D0%B2%D0%BA%D0%B0)
- [Использование](#%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5)
- [Разработка](#%D1%80%D0%B0%D0%B7%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%BA%D0%B0)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Установка

```bash
composer config repositories.sedmsk.github.io composer https://sedmsk.github.io/composer
composer require --dev sd/dumper:"dev-develop"
```

## Использование
```php

dumper(
    ...$params,         // tag(string), expr(bool|callable)
    ...$args            // mixed
);

dumper(1);              // без тега

dumper(
    tag('tag'),
    tag('user'),
    2
);                      // с тегами tag и user 

dumper(
    expr(true && false),
    3
);                      // не выполнится 

dumper(
    tag('user'),
    expr(function () use ($user) {
        return in_array($user->id, [1, 2, 3]);
    }),
    tag('tag'),
    3
);                      // выполнится с тегами tag и user 
```

## Разработка
1. Клонировать репозиторий в папку `.files/sd/dumper` в корне проекта
1. В composer'е в разделе `repositories` заменить соответствующий блок заменить на 

    ```json
    {
        "type": "path",
        "url": ".files/sd/dumper"
    }
    ``` 
1. Разработка ведётся по [git flow](https://danielkummer.github.io/git-flow-cheatsheet/index.ru_RU.html)
    - После клонирования нужно выполнить `git flow init -df`
1. Установка `php` зависимостей `composer install --no-interaction  --optimize-autoloader` 
1. Установка `js` зависимостей `yarn`
    - Для сборки front-end'а использовать команду `yarn run dev`
