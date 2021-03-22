<?php
/**
 * @var \App\Models\Record $record
 */
?>

<a href="{{ route('record.edit', ['record' => $record->id]) }}"
   class="btn btn-outline-info"><i class="fa fa-pen-alt"></i> {{ __('buttons.record.edit') }}</a>

<form action="{{ route('record.destroy', $record->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline-danger" title="Delete">
        <i class="fa fa-trash-alt"></i> {{ __('buttons.record.delete') }}
    </button>
</form>

<table class="table table-hover mt-4">
    <tbody>
    <tr>
        <th scope="row">{{ __('record.table.procedure_id') }}</th>
        <td>{{ $record->procedure->name }}</td>
    </tr>
    <tr>
        <th scope="row">{{ __('record.table.client_id') }}</th>
        <td>{{ $record->client_id }}</td>
    </tr>
    <tr>
        <th scope="row">{{ __('record.table.date_start') }}</th>
        <td>{{ $record->date_start }}</td>
    </tr>
    <tr>
        <th scope="row">{{ __('record.table.date_end') }}</th>
        <td>{{ $record->date_end }}</td>
    </tr>
    <tr>
        <th scope="row">{{ __('record.table.status') }}</th>
        <td>{{ $record->status }}</td>
    </tr>
    <tr>
        <th scope="row">{{ __('record.table.price') }}</th>
        <td>{{ $record->price }}</td>
    </tr>
    </tbody>
</table>
