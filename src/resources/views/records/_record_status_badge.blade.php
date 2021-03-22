<?php
/**
 * @var \App\Models\Record $record
 */
?>

@switch($record->status)
    @case(\App\Models\Record::STATUS_NOT_DONE)
        <span class="badge badge-secondary">
            {{ __('buttons.record.statuses.' . $record->getStatusKey()) }}
        </span>
    @break
    @case(\App\Models\Record::STATUS_DONE)
        <span class="badge badge-success">
            {{ __('buttons.record.statuses.' . $record->getStatusKey()) }}
        </span>
    @break
    @case(\App\Models\Record::STATUS_CANCELED)
        <span class="badge badge-danger">
            {{ __('buttons.record.statuses.' . $record->getStatusKey()) }}
        </span>
    @break
    @case(\App\Models\Record::STATUS_MOVED)
        <span class="badge badge-info">
            {{ __('buttons.record.statuses.' . $record->getStatusKey()) }}
        </span>
    @break
@endswitch
