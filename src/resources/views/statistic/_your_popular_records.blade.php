<?php
/**
 * @var \Illuminate\Support\Collection $proceduresPopular
 */
?>

<ul class="list-group">
    @foreach($proceduresPopular as $procedure)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ $procedure->procedure }}

            <span class="badge badge-primary badge-pill">{{ $procedure->count }}</span>
        </li>
    @endforeach
</ul>
