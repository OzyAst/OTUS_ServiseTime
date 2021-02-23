<?php
/**
 * @var \App\Models\Business $business
 * @var \App\Models\Procedure $prcedure
 */
?>
<section id="procedures">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">{{ __('headers.constructor.procedure') }}</h1>
    </div>

    <div class="container pb-4">
        <div class="card-deck mb-3 text-center">
            @forelse($business->procedures as $procedure)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">{{ $procedure->name }}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{ $procedure->price }} р.</h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>
                                {{ __('procedure.table.duration') }}:
                                <i class="far fa-clock"></i> {{ $procedure->duration }} мин.
                            </li>
                        </ul>

                        <button type="button" class="btn btn-lg btn-block btn-outline-primary" id="timetable_modal_show"
                                data-toggle="modal" data-target="#procedure_timetable"
                                data-procedure_id="{{ $procedure->id }}" data-procedure_name="{{ $procedure->name }}">
                            {{ __('buttons.procedure.recording') }}
                        </button>
                    </div>
                </div>
            @empty
                <div class="text-center flex-grow-1">
                    <a href="{{ route('procedure.create') }}">{{ __('buttons.procedure.add_construct') }}</a>
                </div>
            @endforelse
        </div>

        @if($business->procedures->count() > 3)
        <div class="text-center">
            <a href="#">Все процедуры ...</a>
        </div>
        @endif
    </div>

    <div class="modal fade" id="procedure_timetable" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    @include('constructor._timetable')
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script src="{{ asset('/js/pages/pages.js') }}"></script>
<script src="{{ asset('/js/pages/timetable.js') }}"></script>
@stop
