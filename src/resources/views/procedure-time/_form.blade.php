<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection $times
 * @var \App\Models\ProcedureTime $time
 * @var \App\Models\Procedure $procedure
 */

$first = $times->first();

$route = $first->procedure_id ? 'time.update' : 'time.store';
$route_params = $first->procedure_id ? ["procedure" => $first->procedure_id] : [];
$method = $first->procedure_id ? "PATCH" : "POST";
?>

@extends('blocks._form')

@section('form_content')
    <input type="hidden" name="procedure_id"
           value="{{ $first->procedure_id ? $first->procedure_id : $procedure->id }}">

    <table class="table table-hover mt-2">
        <thead>
        <tr class="text-center">
            <th>{{ __('forms.time.add.day') }}</th>
            <th>{{ __('forms.time.add.start') }}</th>
            <th>{{ __('forms.time.add.end') }}</th>
            <th>{{ __('forms.time.add.day_off') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($days as $day)
            <?php $time = $times->where("day", $loop->index)->first() ?>

            <tr>
                <td>
                    <label class="col-sm-2 col-form-label">{{ __('week.long.' . $day) }}</label>
                    <input type="hidden" name="day[]" value="{{ $loop->index }}">
                </td>

                <td>
                    <input type="text" class="form-control" name="start[]"
                           value="{{ $time->start }}">
                </td>

                <td>
                    <input type="text" class="form-control" name="end[]"
                           value="{{ $time->end }}">
                </td>

                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input"
                               name="day_off[{{ $loop->index }}]" id="day_off[{{ $loop->index }}]"
                               {{ $time->day_off ? 'checked' : '' }} value="{{ $time->day_off }}">
                        <label class="custom-control-label" for="day_off[{{ $loop->index }}]"></label>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="form-group text-right py-4">
        <button type="submit" class="btn btn-primary">
            {{ $first->procedure_id ? __('buttons.time.edit') : __('buttons.time.add') }}
        </button>
    </div>
@stop
