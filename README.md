###Deploy
```cmd
src/vendor/bin/envoy run deploy
```

### Test
Запуск тестов
```cmd
vendor/bin/phpunit 
```
Запуск отдельного теста
```cmd
vendor/bin/phpunit --debug --filter BusinessControllerTest 
```

### Cron
Добавляем задачу в крон
```
* * * * * cd /var/www/html && php artisan sсhedule:run >> /dev/null 2>&1
```