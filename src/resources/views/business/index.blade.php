<?php
/**
 * @var \App\Models\Business $business
 */
?>

@extends('layouts.main')

@section('title', __('headers.business.constructor'))

@can('accessBusinessPanel')
    @section('header_button')
        <a href="{{ route("business.edit", ['business' => $business->id]) }}" type="button" class="btn btn-outline-primary">
            <i class="fa fa-pen-alt"></i> {{ __('buttons.business.settings') }}
        </a>
    @stop
@endcan

@section('content')

    @include('blocks._header')

    <div class="border border-info">
        @include('constructor._constructor')
    </div>

@stop
