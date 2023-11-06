@extends('layouts.app')

@section('title', 'Work Slot Bids')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Work Slot Bids</h1>
        <a href="{{ route('workslotbids.create') }}" class="btn btn-sm btn-primary">
    <i class="fas fa-plus"></i> Add New
</a>

    </div>


    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Workslots</h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%">Work Date</th>
                            <th width="15%">Start Time</th>
                            <th width="15%">End Time</th>
                            <!---<th width="15%">User Name</th> -->
                            <th width="15%">Applied On</th>
                            <th width="15%">Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($workslotbids as $workslotbid)
                           <tr>
                               <td>{{$workslots->find($workslotbid->work_slot_id)->date}}</td>
                               <td>{{$workslots->find($workslotbid->work_slot_id)->start_time }}</td>
                               <td>{{$workslots->find($workslotbid->work_slot_id)->end_time}}</td>
                               <!---
                               <td>{{$users->find($workslotbid->user_id)->first_name . ' '. $users->find($workslotbid->user_id)->last_name}}</td>
                                -->
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
                                <td class="form-control-user" style="display: flex">
                                    <form method="POST" action="{{ route('workslotbids.destroy', ['workslotbid' => $workslotbid->id]) }}">
                                        @csrf
                                        @method('DELETE') <!-- Use POST method with _method field to simulate DELETE -->
                                        <input type="hidden" name="id" value="{{ $workslotbid->id }}">
                                        <button class="btn btn-danger m-2" type="submit">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>


                           </tr>
                       @endforeach
                    </tbody>
                </table>

                {{$workslotbids->links()}}
            </div>
        </div>
    </div>

</div>

@endsection
@section('scripts')

<!-- tables scripts -->
@include('common.tables')
<!-- End of tables scripts -->



@endsection