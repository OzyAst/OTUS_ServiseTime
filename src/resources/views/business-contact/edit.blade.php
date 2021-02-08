@extends('layouts.main')

@section('title', __('headers.contact.edit'))

@section('header_button')
    <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger" title="Delete">
            <i class="fa fa-trash-alt"></i> {{ __('buttons.contact.delete') }}
        </button>
    </form>
@stop

@section('content')

    @include('blocks._header')

    @include('business-contact._form')

@stop
