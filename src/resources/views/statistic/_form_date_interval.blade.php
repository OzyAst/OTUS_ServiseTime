<?php
/**
 * @var \Carbon\Carbon $date_start
 * @var \Carbon\Carbon $date_end
 * @var string $url
 */
?>

<form action="{{ $url }}" method="GET" class="my-4">
    <div class="form-row">
        <div class="col-md-5">
            <input type="text" class="form-control" name="date_start" placeholder="Дата"
                   value="{{ $date_start->format("d.m.Y") }}">
        </div>
        <div class="col-md-5">
            <input type="text" class="form-control" name="date_end" placeholder="Дата"
                   value="{{ $date_end->format("d.m.Y") }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-block btn-outline-info">{{ __('buttons.filter') }}</button>
        </div>
    </div>
</form>
