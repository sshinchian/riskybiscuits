@extends('layouts.app')

@section('title', 'View Workslots')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Workslots</h1>
    </div>

    @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CafeOwner'))
    <div class="col-md-6" style="margin-bottom:20px;">
        <a href="{{ route('workslot.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Add New
        </a>

        <a style="margin-left:10px;" href="{{ route('workslot.import') }}" class="btn btn-sm btn-success">
            <i class="fas fa-check"></i> Import Workslots
        </a>
    </div>
    @endif


    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Workslots</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{-- <th width="15%">Shift Name</th> --}}
                            <th width="15%">Date</th>
                            <th width="15%">Role</th>
                            <th width="15%">Start Time</th>
                            <th width="15%">End Time</th>
                            <th width="15%">Staff Required</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($workSlots as $workslot)
                        <tr>
                            {{-- <td>{{ $workslot->time_slot_name }}</td> --}}
                            <td>{{ $workslot->start_date }}</td>
                            <td>{{$workslot->role->name}}</td>
                            <td>{{ $workslot->start_time }}</td>
                            <td>{{ $workslot->end_time }}</td>
                            <td>{{ $workslot->quantity }}</td>

                            @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CafeOwner'))
                            <td style="display: flex">
                                <a href="{{ route('workslot.edit', ['workSlot' => $workslot->id]) }}"
                                    class="btn-sm btn-primary m-2">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <a class="btn-sm btn-danger m-2" href="#" data-toggle="modal"
                                    data-target="#deleteWorkslotModal{{ $workslot->id }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>

                            @elseif(auth()->user()->hasRole('Staff'))
                            <td style="display: flex">
                                <a href="{{-- {{ route('workslot.edit', ['workSlot' => $workslot->id]) }} --}}"
                                    class="btn-sm btn-success m-2">
                                    <i class="fas fa-check"></i>
                                </a>
                            </td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('workslot.delete-modal')

@endsection

@section('scripts')

<!-- tables scripts -->
@include('common.tables')
<!-- End of tables scripts -->

@endsection
