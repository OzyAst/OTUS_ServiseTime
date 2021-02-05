@servers(['web' => 'pi@192.168.1.36'])
@setup
    $DIR = '/var/www';
    $DIR_CURRENT = $DIR . '/current';
    $DIR_PREV = $DIR . '/prev';
    $DIR_RELEASE = $DIR . '/release';
    $DIR_SOURCE = date("YmdHi");
    $DIR_APP = $DIR_RELEASE . '/' . $DIR_SOURCE . "/src";
    $DIR_ENV = $DIR . '/.env';

    $URL_GIT = 'https://github.com/OzyAst/OTUS_ServiseTime.git';
    $GIT_BRANCH = 'master';
@endsetup

@import('resources/envoy/before-deploy.blade.php')
@import('resources/envoy/git.blade.php')
@import('resources/envoy/composer.blade.php')
@import('resources/envoy/config.blade.php')
@import('resources/envoy/migrate.blade.php')
@import('resources/envoy/test.blade.php')
@import('resources/envoy/frontend-build.blade.php')
@import('resources/envoy/cache.blade.php')
@import('resources/envoy/access.blade.php')
@import('resources/envoy/active-release.blade.php')
@import('resources/envoy/workers.blade.php')
@import('resources/envoy/remove-old-release.blade.php')

@story('deploy')
    beforeDeploy
    git
    composer
    config
    migration
    test
    frontend
    cache
    access
    active_release
    reboot_workers
    remove_old_release
@endstory



