<?php
/**
 * @var \Carbon\Carbon $date_start
 * @var \Carbon\Carbon $date_end
 * @var \App\Services\Statistic\DTO\StatisticForRecordsAggregateDTO[] $statistic
 */
?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('statistic.table.records.procedure_name') }}</th>
        <th scope="col">{{ __('statistic.table.records.status') }}</th>
        <th scope="col">{{ __('statistic.table.records.count') }}</th>
        <th scope="col">{{ __('statistic.table.records.sum_price') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($statistic as $stat)
        @php $countStatus = count($stat->statuses) + 1 @endphp

        <tr>
            <th scope="row" rowspan="{{ $countStatus }}">{{ $loop->iteration }}</th>
            <td rowspan="{{ $countStatus }}">{{ $stat->procedure_name }}</td>
        </tr>
        @foreach($stat->statuses as $status)
            <tr>
                <td>{{ __('record.statuses.' . $status->status_key) }}</td>
                <td>{{ $status->count }}</td>
                <td>{{ $status->sum_price }}</td>
            </tr>
        @endforeach
    @empty
        <tr>
            <td colspan="333" class="text-center text-muted">
                {{ __('statistic.empty') }}<br/>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
