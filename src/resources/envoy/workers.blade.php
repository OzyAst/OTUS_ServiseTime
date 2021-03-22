{{-- Перезапуск воркеров --}}
@task('reboot_workers')
    sudo supervisorctl reload
@endtask
