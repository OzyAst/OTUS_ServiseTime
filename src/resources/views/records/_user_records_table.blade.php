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
        <th scope="col">{{ __('record.table.status') }}</th>
        <th scope="col" class="text-center"><i class="fa fa-bolt"></i></th>
    </tr>
    </thead>
    <tbody>
    @forelse($records as $record)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <th>{{ $record->procedure->name }}</th>
            <td>{{ $record->business->name }}</td>
            <td>{{ date("d M H:i", strtotime($record->date_start)) }}</td>
            <td> @include('records._record_status_badge') </td>
            <td class="text-center">
                <form action="{{ route('record.cancel', $record->id) }}" method="POST"
                      class="<?= $record->isDone() ? 'd-none' : "" ?>">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                        <i class="fa fa-undo-alt"></i> Отменить
                    </button>
                </form>
            </td>
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
