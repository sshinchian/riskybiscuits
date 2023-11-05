@extends('layouts.app')

@section('title', 'View Cafes')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cafes</h1>
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('cafes.createcafe') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('cafes.export') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-check"></i> Export To Excel
                </a>
            </div>

        </div>

    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Cafes</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20%">Name</th>
                            <th width="30%">Address</th>
                            <th width="15%">Mobile</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cafes as $cafe)
                        <tr>
                            <td>{{ $cafe->name }}</td>
                            <td>{{ $cafe->address }}</td>
                            <td>{{ $cafe->mobile_number }}</td>

                            <td style="display: flex">
                                <a href="{{ route('cafes.editcafe', ['cafe' => $cafe->id]) }}"
                                    class="btn-sm btn-primary m-2">
                                    <i class="fa fa-pen"></i>
                                </a>


                              
                                <form method="POST" action="/cafes/deletecafe/{{$cafe->id}}">
                                @csrf
                                @method('DELETE')

                                <button class="btn-sm btn-danger m-2" >
                                    <i class="fas fa-trash"></i>
                                
                                </button>
                                </form>


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
