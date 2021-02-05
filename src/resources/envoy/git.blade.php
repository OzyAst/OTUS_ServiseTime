{{-- Клонирование репозитория создания папки --}}
@task('git')
    cd {{ $DIR_RELEASE }}

    if [ -d "{{ $DIR_SOURCE }}" ]; then
        rm -rf {{ $DIR_SOURCE }}
    fi

    mkdir {{ $DIR_SOURCE }} && cd {{ $DIR_SOURCE }}
    git clone --single-branch --branch {{ $GIT_BRANCH }} {{ $URL_GIT }} .
@endtask
