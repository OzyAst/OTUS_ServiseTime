@extends('layouts.main')

@section('title', __('headers.statistic.records'))

@section('content')

    @include('blocks._header')

    @include('statistic._form_date_interval', [
        'url' => route('statistic.records')
    ])

    @include('statistic._table_records')

@stop
