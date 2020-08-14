<?php
/**
 * @var \App\Models\BusinessAddress $address
 * @var $addresses
 */
?>
<table class="table table-hover mt-4">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('address.table.address') }}</th>
        <th scope="col">{{ __('address.table.contacts') }}</th>
        <th scope="col"><i class="fa fa-bolt"></i></th>
    </tr>
    </thead>
    <tbody>
    @forelse($addresses as $address)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $address->address }}</td>
            <td></td>
            <td>
                <a href="{{ route('address.edit', ['address' => $address->id]) }}"
                   class="btn btn-sm btn-outline-info"><i class="fa fa-pen-alt"></i></a>

                <form action="{{ route('address.destroy', $address->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Delete">
                        <i class="fa fa-trash-alt"></i>
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="333" class="text-center text-muted">
                {{ __('address.empty') }}<br/>

                <a href="{{ route('address.create') }}" class="btn btn-sm btn-outline-success">
                    <i class="fa fa-plus"></i> {{ __('buttons.address.add') }}
                </a>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
