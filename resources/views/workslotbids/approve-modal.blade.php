@foreach ($workslotbids as $workslotbid)
<div class="modal fade" id="approveModal{{ $workslotbid->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalTitle">Approve Workslot Bid</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to approve Workslot Bid for {{ $users->find($workslotbid->user_id)->first_name . ' '. $users->find($workslotbid->user_id)->last_name}}?
                <textarea class="form-control mt-2" form="workslotBidApprove-{{ $workslotbid->id }}" name="remarks" cols="40" rows="5" placeholder="reason for approval/rejection"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form id="workslotBidApprove-{{ $workslotbid->id }}" method="POST" action="{{ route('workslotbid.update', ['workSlotBid' => $workslotbid->id]) }}">
                    @csrf
                    @method('PUT')
                <a class="btn btn-success" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('workslotBidApprove-{{ $workslotbid->id }}').submit();">
                    Approve
                </a>
                <input type="hidden" name="status" value="1" />
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

