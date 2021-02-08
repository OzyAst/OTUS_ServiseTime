@extends('layouts.main')

@section('title', __('headers.address.add'))

@section('content')

    @include('blocks._header')

    @include('business-address._form')

@stop
