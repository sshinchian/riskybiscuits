@extends('layouts.app')
@section('title', 'Staff Role Bids')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Staff Role Bids</h1>
        <a href="{{route('staffrolebid.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>
    {{-- Alert Messages --}}
    @include('common.alert')
     <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Staff Roles</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%">Role</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @foreach ($staffroles as $staffrole)
                            @php
                                $existingBid = $staffrolebids->where('staff_role_id', $staffrole->id)->where('user_id', auth()->user()->id)->first();
                            @endphp

                        <tr>
                            <td>{{ $staffrole->name }}</td>
                           
                            <td style="display: flex">
                             <!-- To become bid button 
                                <a href="{{-- {{ route('cafes.editcafe', ['cafe' => $workslot->id]) }} --}}"
                                    class="btn-sm btn-primary m-2">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="{{ route('cafes.editcafe', ['cafe' => $workslot->id, 'action' => 'add']) }}"
                                    class="btn-sm btn-primary m-2">
                                    <i class="fa fa-plus"></i>
                                </a>
                              
                                <form method="POST" action="{{-- /cafes/deletecafe/{{$workslot->id}} --}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn-sm btn-danger m-2" >
                                    <i class="fas fa-trash"></i>
                                
                                </button>
                                </form>
                                -->
                         
                                @if (!$existingBid)
                                    <form method="POST" action="{{ route('staffrolebid.store') }}">
                                        @csrf
                                        <input type="hidden" name="staff_role_id" value="{{ $staffrole->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <button type="submit" class="btn btn-primary">Bid</button>
                                    </form>
                                @else
                                <span>-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- @include('users.deleterecord-modal') --}}
@endsection
@section('scripts')
<!-- tables scripts -->
@include('common.tables')
<!-- End of tables scripts -->
@endsection