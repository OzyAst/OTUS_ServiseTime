<?php

use App\Models\Record;

/**
 * @var \App\Models\Record $record
 * @var array $records
 */
?>

<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('record.table.procedure_id') }}</th>
        <th scope="col">{{ __('record.table.business_id') }}</th>
        <th scope="col">{{ __('record.table.time') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($records as $record)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <th>{{ $record->procedure->name }}</th>
            <td>{{ $record->business->name }}</td>
            <td>{{ date("d M H:i", strtotime($record->date_start)) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="333" class="text-center text-muted">
                {{ __('record.empty') }}<br/>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
