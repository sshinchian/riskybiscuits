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

                    {{-- Date --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Date</label>
                        <input 
                            type="date" 
                            class="form-control form-control-user @error('date') is-invalid @enderror" 
                            id="date"
                            placeholder="Date" 
                            name="date" 
                            value="{{ old('date') ?  old('date') : $workSlot->date}}">

                        @error('date')
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


                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Update</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('cafes.viewcafe') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection