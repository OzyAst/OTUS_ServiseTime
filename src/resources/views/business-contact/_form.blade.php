<?php
/**
 * @var \App\Models\BusinessContact $contact
 * @var \App\Models\BusinessContactType $type
 * @var \App\Models\BusinessAddress $address
 */

$route = $contact->id ? 'contact.update' : 'contact.store';
$route_params = $contact->id ? ["contact" => $contact->id] : [];
$method = $contact->id ? "PATCH" : "POST";
?>

@extends('blocks._form')

@section('form_content')
    <input type="hidden" name="business_address_id"
           value="{{ $contact->id ? $contact->business_address_id : $address->id }}">

    <div class="form-row">
        <div class="col-4">
            <label for="type_id">{{ __('forms.contact.add.type_id') }}</label>
            <select class="form-control" name="type_id">
                @foreach($types as $type)
                    <option value="{{ $type->id }}"
                        {{ $contact->type_id == $type->id ? "selected" : "" }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label for="contact">{{ __('forms.contact.add.contact') }}</label>
            <input type="text" class="form-control" name="contact" value="{{ $contact->contact }}">
        </div>
    </div>

    <div class="form-group text-right py-4">
        <button type="submit" class="btn btn-primary">
            {{ $contact->id ? __('buttons.contact.edit') : __('buttons.contact.add') }}
        </button>
    </div>
@stop
