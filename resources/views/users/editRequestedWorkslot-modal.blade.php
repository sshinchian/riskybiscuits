@foreach ($users as $user)
<div class="modal fade" id="saveModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="saveModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saveModalTitle">Edit Requested Workslots</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to edit the number of requested workslots for {{ $user->first_name . ' '. $user->last_name}}?
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="requestedWorkslotSave-{{ $user->id }}" method="POST" action="{{ route('users.updateslots', ['user' => $user->id]) }}">
                    @csrf
                    @method('PUT')
                <a class="btn btn-success" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('requestedWorkslotSave-{{ $user->id }}').submit();">
                    Save
                </a>
                <input id="hiddenInput" type="hidden" name="requested_workslots" />
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

