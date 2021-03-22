<?php
/**
 * @var \Carbon\Carbon $date_start
 * @var \Carbon\Carbon $date_end
 * @var array $statistic
 */
?>

@extends('layouts.main')

@section('title', __('headers.statistic.salary'))

@section('content')

    @include('blocks._header')

    @include('statistic._form_date_interval', [
        'url' => route('statistic.salary')
    ])

    @include('statistic._table_salary')

@stop
