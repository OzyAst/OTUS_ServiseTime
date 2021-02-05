{{-- Установка зависимостей --}}
@task('composer')
    cd {{ $DIR_APP }}
    composer install
@endtask
