@extends('layouts.main')

@section('title', "#".$record->id)

@section('content')

    @include('blocks._header')

    @include('records._detail')

@stop
