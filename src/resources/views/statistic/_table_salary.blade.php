<?php
/**
 * @var \Carbon\Carbon $date_start
 * @var \Carbon\Carbon $date_end
 * @var \App\Services\Statistic\DTO\StatisticSalaryDTO[] $statistic
 */
?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('statistic.table.salary.procedure_name') }}</th>
        <th scope="col">{{ __('statistic.table.salary.count_done') }}</th>
        <th scope="col">{{ __('statistic.table.salary.sum_price') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($statistic as $stat)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $stat->procedure_name }}</td>
            <td>{{ $stat->count }}</td>
            <td>{{ $stat->sum_price }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="333" class="text-center text-muted">
                {{ __('statistic.empty') }}<br/>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
