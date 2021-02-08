<?php
/**
 * @var \App\Models\BusinessContact $contact
 */
?>
<table class="table table-sm">
    @foreach($contacts as $contact)
        <tr>
            <td>
                {{ $contact->contact }}
            </td>
            <td>
                <a href="{{ route('contact.edit', ['contact' => $contact->id]) }}"
                   class=""><i class="fa fa-pen-alt"></i></a>

                <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-link p-0" title="Delete">
                        <i class="fa fa-trash-alt text-danger"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
