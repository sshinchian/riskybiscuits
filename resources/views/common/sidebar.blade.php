<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-cookie-bite"></i>
        </div>
        <div  class="sidebar-brand-text mx-3">RiskyBiscuits</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if(auth()->user()->hasRole('SuperAdmin') || auth()->user()->hasRole('CafeOwner'))

    <div class="sidebar-heading">
        Management
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#taTpDropDown"
            aria-expanded="true" aria-controls="taTpDropDown">
            <i class="fas fa-user-alt"></i>
            <span>Users</span>
        </a>
        <div id="taTpDropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">User Management</h6> --}}
                <a class="collapse-item" href="{{ route('users.index') }}">View Users</a>
                @if(auth()->user()->hasRole('SuperAdmin'))
                <a class="collapse-item" href="{{ route('users.create') }}">Add New User</a>
                <a class="collapse-item" href="{{ route('users.import') }}">Import Users</a>
                @endif
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @endif


    @if(auth()->user()->hasRole('SuperAdmin'))
    <!-- Heading -->
    <div class="sidebar-heading">
        Cafe
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cafes"
            aria-expanded="true" aria-controls="cafes">
            <i class="fas fa-table"></i>
            <span>Manage Cafe</span>
        </a>
        <div id="cafes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('cafes.viewcafe') }}">View Timeslots</a>
                <a class="collapse-item" href="{{ route('cafes.createcafe') }}">Add New Cafe</a>
                <a class="collapse-item" href="{{ route('cafes.archive') }}">Deleted Cafes</a>
                <a class="collapse-item" href="{{ route('cafes.import') }}">Import Cafes</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @endif



    @if(auth()->user()->hasRole('SuperAdmin')  || auth()->user()->hasRole('CafeOwner'))
    <!-- Heading -->
    <div class="sidebar-heading">
        Workslots
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#workslots"
            aria-expanded="true" aria-controls="workslots">
            <i class="fas fa-table"></i>
            <span>Manage Workslots</span>
        </a>
        <div id="workslots" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('workslot.index') }}">View Workslots</a>
                <a class="collapse-item" href="{{ route('workslot.create') }}">Add New Slot</a>
                {{-- <a class="collapse-item" href="{{ route('cafes.archive') }}">Deleted Cafes</a>
                <a class="collapse-item" href="{{ route('cafes.import') }}">Import Cafes</a> --}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @endif



    @if(auth()->user()->hasRole('SuperAdmin'))
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Section
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Roles & Permissions</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Roles & Permissions</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
   @endif

    @if(auth()->user()->hasRole('Manager'))
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin Section
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Roles & Permissions</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Roles & Permissions</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                    <a class="collapse-item" href="{{ route('permissions.index') }}">Permissions</a>
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
   @endif

   @if(auth()->user()->hasRole('Manager') || auth()->user()->hasRole('Staff'))
        <!-- Heading -->
        <div class="sidebar-heading">
            Cafe
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bidsPages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Bids</span>
            </a>
            <div id="bidsPages" class="collapse" aria-labelledby="headingBids" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Staff Role Bid</h6>
                    <a class="collapse-item" href="{{ route('staffrolebids.index') }}">View Staff Role Bids</a>
                    
                </div>
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Work Slot Bid</h6>
                    <a class="collapse-item" href="{{ route('workslotbids.index') }}">View Work Slot Bids</a>
                    
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
   @endif
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>