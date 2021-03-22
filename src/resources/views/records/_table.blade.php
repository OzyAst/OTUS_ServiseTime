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
        <th scope="col">{{ __('record.table.client_id') }}</th>
        <th scope="col">{{ __('record.table.time') }}</th>
        <th scope="col"><i class="fa fa-bolt"></i></th>
    </tr>
    </thead>
    <tbody>
    @forelse($records as $record)
        <tr>
            <th scope="row">{{ $record->id }}</th>
            <th>{{ $record->procedure->name }}</th>
            <td>{{ $record->client->name }}</td>
            <td>{{ date("d M H:i", strtotime($record->date_start)) }}</td>
            <td>
                <div class="dropdown mb-1">
                    <form action="{{ route('record.changeStatus', $record->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status" value="0">

                        <a class="btn btn-outline-secondary btn-sm dropdown-toggle" href="#" role="button"
                           id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('buttons.record.statuses.' . $record->getStatusKey()) }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" data-id="<?= Record::STATUS_DONE ?>"
                               onclick="this.closest('form').querySelector('input[name=status]').value = this.dataset.id;
                                        this.closest('form').submit();"
                            >{{ __('buttons.record.statuses.done') }}</a>

                            <a class="dropdown-item" href="#" data-id="<?= Record::STATUS_NOT_DONE ?>"
                               onclick="this.closest('form').querySelector('input[name=status]').value = this.dataset.id;
                                        this.closest('form').submit();"
                            >{{ __('buttons.record.statuses.not_done') }}</a>

                            <a class="dropdown-item" href="#" data-id="<?= Record::STATUS_CANCELED ?>"
                               onclick="this.closest('form').querySelector('input[name=status]').value = this.dataset.id;
                                        this.closest('form').submit();"
                            >{{ __('buttons.record.statuses.canceled') }}</a>

                            <a class="dropdown-item" href="#" data-id="<?= Record::STATUS_MOVED ?>"
                               onclick="this.closest('form').querySelector('input[name=status]').value = this.dataset.id;
                                        this.closest('form').submit();"
                            >{{ __('buttons.record.statuses.moved') }}</a>
                        </div>
                    </form>
                </div>

                <a href="{{ route('record.show', ['record' => $record->id]) }}"
                   class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a>

                <a href="{{ route('record.edit', ['record' => $record->id]) }}"
                   class="btn btn-sm btn-outline-info"><i class="fa fa-pen-alt"></i></a>

                <form action="{{ route('record.destroy', $record->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                        <i class="fa fa-trash-alt"></i>
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
