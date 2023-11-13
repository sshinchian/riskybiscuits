@extends('layouts.app')

@section('title', 'Work Slot Bids')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Work Slot Bids</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if(auth()->user()->role_id == 3)
                <h6 class="m-0 font-weight-bold text-primary">All Work Slot Bids</h6>
            @elseif(auth()->user()->role_id == 4)
                <h6 class="m-0 font-weight-bold text-primary">My Work Slot Bids</h6>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="10%">Date</th>
                            <th width="15%">Time</th>
                            <th width="10%">Role</th>
                            @if(auth()->user()->role_id == 3)
                            <th width="15%">User Name</th>
                            @endif
                            <th width="20%">Applied On</th>
                            <th width="15%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $workslotbids = $workslotbids->where('status','<=', 1);
                        @endphp
                        @foreach ($workslotbids as $workslotbid)
                        <tr>
                            <td>{{ optional($workslots->find($workslotbid->work_slot_id))->start_date }}</td>
                            
                            <td>{{ optional($workslots->find($workslotbid->work_slot_id))->start_time .
                            ' - ' . optional($workslots->find($workslotbid->work_slot_id))->end_time }}</td>

                            <td>
                                @if(optional($workslots->find($workslotbid->work_slot_id))->staff_role_id == 1)
                                    Cashier
                                @elseif(optional($workslots->find($workslotbid->work_slot_id))->staff_role_id == 2)
                                    Chef
                                @elseif(optional($workslots->find($workslotbid->work_slot_id))->staff_role_id == 3)
                                    Waiter
                                @endif
                            </td>


                            @if(auth()->user()->role_id == 3)
                                <td>{{ optional($users->find($workslotbid->user_id))->first_name . 
                                ' ' . optional($users->find($workslotbid->user_id))->last_name }}</td>
                            @endif

                            
                            <td>{{$workslotbid->updated_at->format('d/m/Y h:i A')}}</td>
                            <td>
                                @if($workslotbid->status == 1)
                                    Approved
                                @elseif($workslotbid->status == -1)
                                    Rejected
                                @elseif($workslotbid->status == 0)
                                    Pending Approval
                                @endif
                            </td>
                            
                            @if((auth()->user()->role_id==4) && ($workslotbid->status == 0))
                            <td class="form-control-user" style="display: flex">
                                <a id="btnDelete" class="btn-sm btn-danger m-2" href="#" data-toggle="modal" 
                                    data-target="#deleteModal{{$workslotbid->id}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>

                            @elseif((auth()->user()->role_id==3) && ($workslotbid->status == 0))
                            <td class="form-control-user" style="display: flex">
                                <a id="btnApprove" class="btn-sm btn-success m-2" href="#" data-toggle="modal"
                                    data-target="#approveModal{{$workslotbid->id}}">
                                    <i class="fas fa-check"></i>
                                </a>
                                
                                <a id="btnReject" class="btn-sm btn-danger m-2" href="#" data-toggle="modal"
                                    data-target="#rejectModal{{$workslotbid->id}}">
                                    <i class="fas fa-times"></i>
                                </a>
                            </td>
                            
                            @elseif($workslotbid->status != 0)
                            <td>-</td>
                            @endif
                        </tr>
                        @php
                            $previousBid = $workslotbid;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                {{-- {{$workslotbids->links()}} --}}
            </div>
        </div>
    </div>
</div>
@include('workslotbids.approve-modal')
@include('workslotbids.reject-modal')
@include('workslotbids.delete-modal')
@endsection

@section('scripts')
    @include('common.tables')
@endsection