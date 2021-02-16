@task('beforeDeploy')
    if [ ! -d "{{ $DIR_RELEASE }}" ]; then
        mkdir {{ $DIR_RELEASE }}
    fi
@endtask
