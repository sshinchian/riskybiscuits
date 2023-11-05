@extends('layouts.app')

@section('title', 'Edit Workslot')

@section('content')



<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Workslot</h1>
        <a href="{{route('workslot.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Workslot</h6>
        </div>
        <form method="POST" action="{{route('workslot.update', ['workSlot' => $workSlot->id])}}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group row">


                    {{-- Staff Role --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Staff Role</label>
                        <select name="staff_role_id" id="staff_role_id" class="form-control">
                            @foreach($staffRoles as $staffRole)
                                <option value="{{ $staffRole->id }}" @if($staffRole->id == $workSlot->staff_role_id) selected @endif>{{ $staffRole->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Date --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Date</label>
                        <input 
                            type="date" 
                            class="form-control form-control-user @error('start_date') is-invalid @enderror" 
                            id="start_date"
                            placeholder="Date" 
                            name="start_date" 
                            value="{{ old('start_date') ?  old('start_date') : $workSlot->start_date}}">

                        @error('start_date')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Start Time --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Start Time</label>
                        <input 
                            type="time" 
                            class="form-control form-control-user @error('start_time') is-invalid @enderror" 
                            id="start_time"
                            placeholder="Start Time" 
                            name="start_time" 
                            value="{{ old('start_time') ?  old('start_time') : $workSlot->start_time}}">

                        @error('start_time')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- End Time --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>End Time</label>
                        <input 
                            type="time" 
                            class="form-control form-control-user @error('end_time') is-invalid @enderror" 
                            id="end_time"
                            placeholder="End Time" 
                            name="end_time" 
                            value="{{ old('end_time') ?  old('end_time') : $workSlot->end_time}}">

                        @error('end_time')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Quantity --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Quantity</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('quantity') is-invalid @enderror" 
                            id="quantity"
                            placeholder="Total Staff Required" 
                            name="quantity" 
                            value="{{ old('quantity') ?  old('quantity') : $workSlot->quantity}}">

                        @error('quantity')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Update</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('workslot.index') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>

@endsection