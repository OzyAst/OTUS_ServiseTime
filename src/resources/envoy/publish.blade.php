{{-- Публикация файлов из пакетов --}}
@task('config')
    cd {{ $DIR_APP }}
    php artisan vendor:publish --force --provider="ServiceTime\Calendar\CalendarServiceProvider"
@endtask
