@extends('layouts.main')

@section('title', __('headers.index'))

@section('content')

    @include('blocks._header')

    @include('records._user_records_table', ['records' => $myRecords])

@stop
