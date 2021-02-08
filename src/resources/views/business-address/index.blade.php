@extends('layouts.main')

@section('title', __('headers.address.index'))

@section('header_button')
    <a href="{{ route('address.create') }}" class="btn btn-outline-success">
        {{ __('buttons.address.add') }}
    </a>
@stop

@section('content')

    @include('blocks._header')

    @include('business-address._table')

@stop
