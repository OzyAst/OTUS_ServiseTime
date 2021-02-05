{{-- Тесты --}}
@task('test')
    cd {{ $DIR_APP }}
    vendor/bin/phpunit
@endtask
