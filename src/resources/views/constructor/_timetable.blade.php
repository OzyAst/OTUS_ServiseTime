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
    @include('service-time-calendar::_calendar')
</section>

