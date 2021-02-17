<?php
/**
 * @var \App\Models\Business $business
 */
?>

<section class="jumbotron text-center bg-image"
         style="background:url('/images/business/types/<?= $business->type->key ?>.jpg') 100%;">
    <div class="container text-light py-md-5 my-md-5">
        <h6>{{ $business->type->name }}</h6>
        <h1>{{ $business->name }}</h1>
        <p class="lead mt-5">
            {{ __('business.businesses.'. $business->type->key . '.slogan') }}
        </p>
    </div>
</section>
