<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
@include('constructor._menu')

@include('constructor._carousel')

@include('constructor._procedures', ['constructor' => 1])

@include('constructor._address')

@include('constructor._feedback')

@include('constructor._footer')
