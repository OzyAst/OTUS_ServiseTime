@extends('layouts.main')

@section('title', __('headers.address.edit'))

@section('header_button')
    <form action="{{ route('address.destroy', $address->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger" title="Delete">
            <i class="fa fa-trash-alt"></i> {{ __('buttons.address.delete') }}
        </button>
    </form>
@stop

@section('content')

    @include('blocks._header')

    @include('business-address._form')

@stop
