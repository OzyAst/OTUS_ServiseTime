{{-- Накатываем миграции --}}
@task('migration')
    cd {{ $DIR_APP }}
    php artisan migrate --force
@endtask
