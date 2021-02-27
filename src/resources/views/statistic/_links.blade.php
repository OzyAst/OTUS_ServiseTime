<div class="list-group">
    <a href="{{ route('statistic.salary') }}" class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ __('headers.statistic.salary') }}</h5>
        </div>
        <small class="text-muted">Подсчет зарплаты персонала за выбранный период</small>
    </a>
    <a href="{{ route('statistic.records') }}" class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ __('headers.statistic.records') }}</h5>
        </div>
        <small class="text-muted">Детальная статистика по записям за выбранный период</small>
    </a>
    <a href="{{ route('statistic.clients') }}" class="list-group-item list-group-item-action">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ __('headers.statistic.clients') }}</h5>
        </div>
        <small class="text-muted">Детальная статистика по клиентам за выбранный период</small>
    </a>
</div>
