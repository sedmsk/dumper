# dumper

## .env
```
# .env
# Расположение проекта на машине разработчика
LOCAL_ROOT=/Users/Shared/Projects/SEDv1-MSK

# Расположение дампов на сервере
STORAGE_DIR=/var/www/igor/tmp/
```

## Использование
```php
dumper(1);      // без тега
dumper()
    ::setTag('tag')
    ::dump(2);  // с тегом tag
dumper()
    ::setTagOnce('once')
    ::dump(3)   // с тегом once
    ::dump(4)   // с тегом tag
    ::unsetTag()
    ::dump(5);  // без тега
```
