{{-- Разрешения --}}
@task('access')
    cd {{ $DIR_APP }}
    chgrp -R www-data storage bootstrap/cache
    chmod -R ug+rwx storage bootstrap/cache
@endtask
