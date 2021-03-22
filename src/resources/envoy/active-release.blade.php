{{-- Активация релиза --}}
@task('active_release')
    if [ -L "{{ $DIR_PREV }}" ]; then
        rm {{ $DIR_PREV }}
    fi
    ln -s $(readlink {{ $DIR_CURRENT }}) {{ $DIR_PREV }}

    if [ -L "{{ $DIR_CURRENT }}" ]; then
        rm {{ $DIR_CURRENT }}
    fi
    ln -s {{ $DIR_RELEASE . '/' . $DIR_SOURCE }} {{ $DIR_CURRENT }}
@endtask
