@extends('layouts.main')

@section('title', __('headers.records.edit'))

@section('header_button')
    <form action="{{ route('record.destroy', $record->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger" title="Delete">
            <i class="fa fa-trash-alt"></i> {{ __('buttons.record.delete') }}
        </button>
    </form>
@stop

@section('content')

    @include('blocks._header')

    @include('records._form')

@stop
