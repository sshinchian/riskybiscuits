@extends('layouts.app')

@section('title', 'Deleted Cafes')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Deleted Cafes</h1>
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
             
                                    <form method="POST" action="/cafes/deletecafe/{{$cafe->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-sm btn-danger m-2" >
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    </form>

                                        <a href="{!!route('cafes.restore', ['id' => $cafe->id])!!}" class="btn btn-success m-2">
                                            <i class="fas fa-retweet"></i>
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


@endsection

@section('scripts')

<!-- tables scripts -->
@include('common.tables')
<!-- End of tables scripts -->
    
@endsection
