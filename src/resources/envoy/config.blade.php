{{-- Файлы конфигурации --}}
@task('config')
    cd {{ $DIR_APP }}
    cp {{ $DIR_ENV }} {{ $DIR_APP }}/.env
    php artisan key:generate
@endtask
