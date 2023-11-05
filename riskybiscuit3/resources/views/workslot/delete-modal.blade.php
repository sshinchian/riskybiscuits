@foreach ($workSlots as $workslot)
<div class="modal fade" id="deleteWorkslotModal{{ $workslot->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteWorkslotModalExample"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteWorkslotModalExample">Delete Workslot</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to delete workslot?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('workslot-delete-form-{{ $workslot->id }}').submit();">
                    Delete
                </a>
                <form id="workslot-delete-form-{{ $workslot->id }}" method="POST" action="{{ route('workslot.destroy', ['workSlot' => $workslot->id]) }}">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
