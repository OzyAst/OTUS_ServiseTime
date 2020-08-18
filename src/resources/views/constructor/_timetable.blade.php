<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */

$route = 'feedback.store';
$route_params = [];
$method = "POST";
?>

<section id="timetable" style="background-color: #fff">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ __('constructor.timetable') }}</h1>
        <p class="lead">
            Quickly build an effective pricing table for your potential customers with this Bootstrap example.
            It’s built with default Bootstrap components and utilities with little customization.
        </p>
    </div>

    <div class="container">
        <div id='calendar'></div>
    </div>
</section>

