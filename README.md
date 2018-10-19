# dumper

- [Установка](#установка)
- [Использование](#использование)
- [Разработка](#разработка)

## Установка

1. Нужно иметь RSA ключ в GitLab'е
1. В корне проекта выполнить команду `curl -sSL finagin.github.io/dumper | php`
1. Следовать инструкциям

Интерфейс будет доступен по адресу `{project}.{release}.sedmsk72/dumper`

## Использование
```php

dumper(
    ...$params,         // tag(string), expr(bool|callable)
    ...$args            // mixed
);

dumper(1);              // без тега

dumper(
    tag('tag'),
    
    2
);                      // с тегами tag и user 

dumper(
    expr(true && false),
    3
);                      // не выполнится

                      //  и user 

dumper(
    tag('user'),
    expr(function () {
        return in_array(2, [1, 2, 3]);
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
