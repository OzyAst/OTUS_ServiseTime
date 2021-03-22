<?php
/**
 * @var \Carbon\Carbon $date_start
 * @var \Carbon\Carbon $date_end
 * @var \App\Services\Statistic\DTO\StatisticForClientsAggregateDTO[] $statistic
 */
?>

<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('statistic.table.clients.client_name') }}</th>
        <th scope="col">{{ __('statistic.table.clients.procedure_name') }}</th>
        <th scope="col">{{ __('statistic.table.clients.records_count') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($statistic as $client)
        @php $countProcedures = count($client->procedures) + 1 @endphp

        <tr>
            <th scope="row" rowspan="{{ $countProcedures }}">{{ $loop->iteration }}</th>
            <td rowspan="{{ $countProcedures }}">{{ $client->client_name }}</td>
        </tr>

        @foreach($client->procedures as $procedure)
            <td>{{ $procedure->procedure_name }}</td>
                <td>
                    @foreach($procedure->statuses as $status)
                        <span class="d-flex w-100 justify-content-between">
                            <span>{{ __('record.statuses.' . $status->status_key) }}:</span>
                            <span>{{ $status->count }}</span>
                        </span>
                    @endforeach
                </td>
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
