@extends('layouts.main')

@section('title', __('headers.time.add'))

@section('content')

    @include('blocks._header')

    @include('procedure-time._form')

@stop
