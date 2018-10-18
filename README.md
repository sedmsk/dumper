# dumper

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
1. Разработка ведётся по git flow
    - После клонирования нужно выполнить `git flow init -df`
1. Установка `php` зависимостей `composer install --no-interaction  --optimize-autoloader` 
1. Установка `js` зависимостей `yarn`
    - Для сборки front-end'а использовать команду `yarn run dev`
