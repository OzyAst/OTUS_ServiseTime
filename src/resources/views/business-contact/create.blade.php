@extends('layouts.main')

@section('title', __('headers.contact.add'))

@section('content')

    @include('blocks._header')

    @include('business-contact._form')

@stop
