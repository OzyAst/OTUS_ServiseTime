@extends('layouts.main')

@section('title', __('headers.time.edit'))

@section('content')

    @include('blocks._header')

    @include('procedure-time._form')

@stop
