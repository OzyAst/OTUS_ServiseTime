<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">{{ $business->name }}</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#procedures">{{ __('constructor.procedure') }}</a>
        <a class="p-2 text-dark" href="#addresses">{{ __('constructor.address') }}</a>
        <a class="p-2 text-dark" href="#feedback">{{ __('constructor.feedback') }}</a>
        <a class="p-2 text-dark" href="#timetable">{{ __('constructor.timetable') }}</a>
    </nav>

    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('home') }}" class="btn btn-sm btn-outline-success">
                    <i class="far fa-user-circle"></i> {{ __('buttons.menu.my_page') }}
                </a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-sign-out-alt"></i> {{ __('buttons.menu.logout') }}
                    </button>
                </form>
            @endauth
            @guest
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Вход</a>

                @if (Route::has('register'))
                    <a class="btn btn-success ml-2" href="{{ route('register') }}">Регистрация</a>
                @endif
            @endauth
        </div>
    @endif
</div>
