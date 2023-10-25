@extends('layouts.app')

@section('title', 'Create Workslot')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Workslot</h1>
        <a href="{{route('workslot.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
    
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Workslot</h6>
        </div>
        <form method="POST" action="{{route('workslot.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- Staff Role Selection --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <div class="form-group">
                            <span style="color:red;">*</span>Cafe Role</label>
                            <select name="staff_role_id" id="staff_role_id" class="form-control">
                                @foreach($staffRoles as $staffRole)
                                    <option value="{{ $staffRole->id }}">{{ $staffRole->name }}</option>
                                @endforeach
                            </select>
                        </div>
                     </div>

                    <!-- Force next columns to break to new line -->
                    <div class="w-100"></div>

                    {{-- Workslot Name --}}
                    {{-- div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Workslot Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('time_slot_name') is-invalid @enderror" 
                            id="time_slot_name"
                            placeholder="Workslot Name" 
                            name="time_slot_name" 
                            value="{{ old('time_slot_name') }}">

                        @error('time_slot_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div> --}}


                    {{-- Date --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Date</label>
                        <input 
                            type="date" 
                            class="form-control form-control-user @error('date') is-invalid @enderror" 
                            id="date"
                            placeholder="Date" 
                            name="date" 
                            value="{{ old('date') }}">

                        @error('date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    {{-- Start Time --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Start Time</label>
                        <input 
                            type="time" 
                            class="form-control form-control-user @error('start_time') is-invalid @enderror" 
                            id="start_time"
                            placeholder="Start Time" 
                            name="start_time" 
                            value="{{ old('start_time') }}">

                        @error('start_time')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                
                    {{-- End Time --}}
                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>End Time</label>
                        <input 
                            type="time" 
                            class="form-control form-control-user @error('end_time') is-invalid @enderror" 
                            id="end_time"
                            placeholder="End Time" 
                            name="end_time" 
                            value="{{ old('end_time') }}">

                        @error('end_time')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    

                     {{-- Staff Required --}}
                     <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Staff Required</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('quantity') is-invalid @enderror" 
                            id="quantity"
                            placeholder="Total Staff Required" 
                            name="quantity" 
                            value="{{ old('quantity') }}">

                        @error('quantity')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('workslot.index') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection