@foreach ($staffrolebids as $staffrolebid)
<div class="modal fade" id="approveModal{{ $staffrolebid->id }}" tabindex="-1" role="dialog" aria-labelledby="approveStaffRoleBidModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalTitle">Approve Staff Role Bid</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve Staff Role Bid for {{ $users->find($staffrolebid->user_id)->first_name . ' '. $users->find($staffrolebid->user_id)->last_name}}?
                <textarea class="form-control mt-2" form="staffRoleBidApprove-{{ $staffrolebid->id }}" name="remarks" cols="40" rows="5" placeholder="reason for approval/rejection"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="staffRoleBidApprove-{{ $staffrolebid->id }}" method="POST" action="{{ route('staffrolebid.update', ['staffRoleBid' => $staffrolebid->id]) }}">
                    @csrf
                    @method('PUT')
                <a class="btn btn-success" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('staffRoleBidApprove-{{ $staffrolebid->id }}').submit();">
                    Approve
                </a>
                <input type="hidden" name="status" value="1" />

                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

