<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
@extends('layouts.business')

@section('title', $business->name)

@section('content')
    @include('constructor._carousel')

    @includeWhen($business->procedures->count(), 'constructor._procedures')

    @includeWhen($business->address, 'constructor._address')

    @include('constructor._timetable')

    @include('constructor._feedback')

@stop
