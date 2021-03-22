<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
<footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="container">
    <div class="row">
        <div class="col-12 col-md-2 text-center">
            <img class="mb-2" src="/favicon.ico" alt="" width="50" height="50"><br/>
            Powered by <br/>
            <b><a href="#">ServiceTime</a></b>
        </div>

        <div class="col-6 col-md-4">
            <h5>{{ __('constructor.menu') }}</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="#procedures">{{ __('constructor.procedure') }}</a></li>
                <li><a class="text-muted" href="#addresses">{{ __('constructor.address') }}</a></li>
                <li><a class="text-muted" href="#feedback">{{ __('constructor.feedback') }}</a></li>
                <li><a class="text-muted" href="#timetable">{{ __('constructor.timetable') }}</a></li>
            </ul>
        </div>

        <div class="col-6 col-md-6 text-right">
            <h5>{{ __('constructor.contacts') }}</h5>

            @isset($business->address)
                <ul class="list-unstyled text-small">
                    <li class="mb-3">{{ $business->address->address }}</li>

                    @foreach($business->address->contacts as $contact)
                        <li>{{ $contact->contact }}</li>
                    @endforeach
                </ul>
            @endisset
        </div>
    </div>
    </div>
</footer>
