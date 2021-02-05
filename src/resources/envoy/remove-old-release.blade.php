{{-- Очистка старых релизов --}}
@task('remove_old_release')
    cd {{ $DIR_RELEASE }}
    RELEASE_CURRENT=$(basename $(readlink {{ $DIR_CURRENT }}))
    RELEASE_PREV=$(basename $(readlink {{ $DIR_PREV }}))

    for file in $(ls | grep -v "${RELEASE_CURRENT}" | grep -v "${RELEASE_PREV}")
    do
        if [ -d "$file" ]; then
            sudo rm -rf $file
        fi
    done
@endtask
