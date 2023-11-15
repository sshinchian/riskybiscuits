@extends('layouts.app')

@section('title', 'Requested Workslots')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Requested Workslots</h1>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Requested Workslots</h6>
            
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20%">User Name</th>
                            <th width="20%">Workslots Requested</th>
                            <th width="20%">Workslots Assigned</th>
                            <th width="20%">Workslots Available</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->first_name . ' '. $user->last_name}}</td>
                                <td>
                                    @php
                                        $errorId = "requested_workslots_" . $user->id;
                                    @endphp                    
                                    <input 
                                        type="number" min="1" max="30" 
                                        class="form-control quantity form-control-user @error($errorId) is-invalid @enderror" 
                                        id="exampleSlots"
                                        placeholder="Requested Slots" 
                                        name="requested_workslots_{{$user->id}}" 
                                        form="requestedWorkslotSave-{{ $user->id }}"
                                        value="{{ old('requested_workslots') ? old('requested_workslots') : $user->requested_workslots }}">
                                        @error($errorId)
                                        <span class="text-danger">
                                            {{$message}}
                                        </span>
                                        @enderror
                                    </td>
                                <td>{{$workslotbids->where('user_id', $user->id)->count()}}</td>
                                <td>{{$user->requested_workslots - $workslotbids->where('user_id', $user->id)->count()}}</td>
                                <td class="form-control-user" style="display: flex">
                                    <a id="btnSave" class="btn btn-success save m-2" href="#" data-toggle="modal" data-target="#saveModal{{ $user->id }}">
                                        <i class="fas fa-save"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('users.slotsConfirm-modal')
@endsection

@section('scripts')

@include('common.tables')
@endsection