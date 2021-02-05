{{-- Чистим и прогреваем кэш --}}
@task('cache')
    cd {{ $DIR_APP }}
    php artisan cache:clear
    php artisan cache:warming
    php artisan config:cache
    php artisan route:cache
@endtask
