@extends('layouts.main')

@section('title', __('headers.statistic.clients'))

@section('content')

    @include('blocks._header')

    @include('statistic._form_date_interval', [
        'url' => route('statistic.clients')
    ])

    @include('statistic._table_clients')

@stop
