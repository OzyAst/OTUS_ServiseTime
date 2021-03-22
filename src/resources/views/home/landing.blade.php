@extends('layouts.landing')
@section('styles')
    <link href="/css/landing.css" rel="stylesheet">
@stop

@section('title', __('headers.index'))

@section('banner')
    <div class="jumbotron bg-image" style="background:url('/images/bg_index.jpg') 100%;">
        <div class="container text-light">
            <h1 class="display-3">Развивайте бизнес <br/> с сервисом ServiceTime!</h1>
            <p class="mt-4">
                Онлайн-запись, умная клиентская база, конструктор сайтов и другие бесплатные инструменты
                помогут сэкономить время и не терять клиентов.
            </p>
            <p><a class="btn btn-primary btn-lg mt-5" href="{{ route('register') }}" role="button">Подключить »</a></p>
        </div>
    </div>
@stop

@section('content')
<div class="marketing mt-5">

    <div class="row mt-5" id="features">
        <div class="col-lg-4">
            <img src="/images/features/launch.svg" width="140" height="140" class="mb-3" />
            <h2>Быстрый запуск</h2>
            <p>Регистрация и настройка займет всего пару минут.</p>
        </div>

        <div class="col-lg-4">
            <img src="/images/features/report.svg" width="140" height="140" class="mb-3" />
            <h2>Отчеты</h2>
            <p>Генерируйте отчеты в режиме реальном времени.</p>
        </div>

        <div class="col-lg-4">
            <img src="/images/features/sun.svg" width="140" height="140" class="mb-3" />
            <h2>Своя страница</h2>
            <p>Конструктор сайта, для создания вашей страницы.</p>
        </div>
    </div>


    <hr class="featurette-divider">

    <div class="row featurette" id="about">
        <div class="col-md-7">
            <h2 class="featurette-heading">Возвращайте и удерживайте клиентов</h2>
            <p class="lead">
                Сервис сегментирует клиентскую базу, чтобы вы работали с клиентами наиболее эффективно.
                Предложите скидку тем, кто оставил положительный отзыв или давно к вам не приходил.
            </p>
        </div>
        <div class="col-md-5">
            <img src="/images/client.jpg" class="img-fluid rounded">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Привлекайте новых клиентов</h2>
            <p class="lead">
                Объявления, ведущие на ваш сайт, помогут увеличить количество онлайн-записей
                и принести вам новых ценных клиентов.
            </p>
        </div>
        <div class="col-md-5 order-md-1">
            <img src="/images/new_client.jpg" class="img-fluid rounded">
        </div>
    </div>

</div>
@stop
