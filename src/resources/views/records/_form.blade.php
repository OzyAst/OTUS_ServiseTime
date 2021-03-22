<?php
/**
 * @var \App\Models\Record $record
 */

$route = $record->id ? 'record.update' : 'record.store';
$route_params = $record->id ? ["record" => $record->id] : [];
$method = $record->id ? "PATCH" : "POST";
?>

@extends('blocks._form')

@section('form_content')
    <input type="hidden" name="procedure_id" value="{{ $record->procedure_id }}">

    <div class="form-group">
        <label for="date_start">{{ __('forms.records.add.date_start') }}</label>
        <input type="text" class="form-control" name="date_start" value="{{ $record->date_start }}">
    </div>

    <div class="form-group">
        <label for="date_end">{{ __('forms.records.add.date_end') }}</label>
        <input type="text" class="form-control" name="date_end" value="{{ $record->date_end }}">
    </div>

    <div class="form-group">
        <label for="status">{{ __('forms.records.add.status') }}</label>
        <input type="number" class="form-control" name="status" value="{{ $record->status }}">
    </div>

    <div class="form-group">
        <label for="price">{{ __('forms.records.add.price') }}</label>
        <input type="number" min="1" step="any" class="form-control" name="price" value="{{ $record->price }}">
    </div>

    <div class="form-group text-right py-4">

        <button type="submit" class="btn btn-primary">
            {{ $record->id ? __('buttons.record.save') : __('buttons.record.add') }}
        </button>
    </div>
@stop
