@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Pending Staff Role Approvals -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                    Pending Staff Role Approvals
                                @elseif(auth()->user()->role_id == 4)
                                    Available Workslots
                                @endif
                            </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">
                                @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                                    {{ $pendingStaffRoleApprovalCount }}
                                @elseif(auth()->user()->role_id == 4)
                                    @switch(auth()->user()->staff_role_id)
                                        @case(1) {{ $availableWorkslotsCountForCashier }} @break
                                        @case(2) {{ $availableWorkslotsCountForChef }} @break
                                        @case(3) {{ $availableWorkslotsCountForWaiter }} @break
                                        @default <!-- Non Assigned --> @break
                                    @endswitch
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-check-to-slot fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Workslot Approvals -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">

                            <!-- Counts for SupeAdmin / Owner / Manager -->
                            @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pending Workslot Approvals</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $pendingWorkslotApprovalCount }}</div>

                            <!-- Counts for Staff Roles -->
                            {{-- Chef --}}
                            @elseif(auth()->user()->role_id == 4)
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                My Workslot Bids</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $approvedWorkSlotBids .' / '. $totalWorkSlotBids}}</div>

                            @elseif(auth()->user()->role_id == 4)
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                My Workslot Bids</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"></div>
                            @endif

                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-check-to-slot fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Workslots -->
        @if(auth()->user()->role_id == 1 || auth()->user()->role_id == 2 || auth()->user()->role_id == 3)
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Available Workslots
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ $availableWorkslotsCount }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Total Staff -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Staff</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $staffCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-person fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    
    <!-- Charts section -->
<div class="row">

        <div class="col-xl-6 col-lg-7">
            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Weekly Workslots</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>


        <!-- Staff Roles Chart -->
        <div class="col-xl-6 col-lg-5">
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Staff Roles</h6>
                </div>

                    <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Chef
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Cashier
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Waiter
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Charts section -->


<!-- PHP script tag to pass data to JavaScript -->
<script>
    var countData = <?php echo json_encode($countData); ?>;
    var dayOfWeekCounts = <?php echo json_encode($dayOfWeekCounts); ?>;
</script>

<script src="{{ asset('js/chart-script.js') }}"></script>

</div>
@endsection
