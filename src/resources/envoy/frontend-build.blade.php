{{-- Собираем фронт --}}
@task('frontend')
    cd {{ $DIR_APP }}
    npm install
    npm run prod
@endtask
