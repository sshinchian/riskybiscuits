<?php

namespace App\Http\Controllers;
use App\Models\WorkSlot;
use App\Models\WorkSlotBid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class WorkSlotBidController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:workslotbid-list|workslotbid-create|workslotbid-edit|workslotbid-delete', ['only' => ['index']]);
        $this->middleware('permission:workslotbid-create', ['only' => ['create','store']]);
        $this->middleware('permission:workslotbid-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:workslotbid-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role_id == 3){
            $workslotbids = WorkSlotBid::paginate(10);
            $workslots = WorkSlot::paginate(10);
            $users = User::paginate(10);
            return view('workslotbids.index', [
                'workslotbids' => $workslotbids,
                'workslots' => $workslots,
                'users' => $users
            ]);
        } else if(auth()->user()->role_id == 4) {
            $workslotbids = WorkSlotBid::where('user_id', auth()->user()->id)->paginate(10);
            $workslots = WorkSlot::paginate(10);
            $users = User::query()->where('id', auth()->user()->id)->paginate(10);
            return view('workslotbids.index', [
                'workslotbids' => $workslotbids,
                'workslots' => $workslots,
                'users' => $users
            ]);
        }

    }

    public function viewworkslots()
    {
        $workSlots = WorkSlot::all();
        return view('workslot.viewworkslots', compact('workSlots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('workslotbids.add', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required',
                'guard_name' => 'required'
            ]);
    
            Role::create($request->all());

            DB::commit();
            return redirect()->route('workslotbids.index')->with('success','Roles created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('workslotbids.add')->with('error',$th->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $role = Role::whereId($id)->with('permissions')->first();
        
    //     $permissions = Permission::all();

    //     return view('workslotbids.edit', ['workslotbids' => $workslotbids, 'permissions' => $permissions]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkSlotBid $workSlotBid)
    {
        // Validate Request
        $request->validate([
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            
            $workSlotBid->update([
                'status' => $request->status,
                'remarks' =>$request->remarks,
            ]);
            DB::commit();

            return redirect()->route('workslotbid.index')->with('success','Work Slot Bid updated successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('workslotbid.index',['workSlotBid' => $workSlotBid])->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     DB::beginTransaction();
    //     try {
    
    //         Role::whereId($id)->delete();
            
    //         DB::commit();
    //         return redirect()->route('roles.index')->with('success','Roles deleted successfully.');
    //     } catch (\Throwable $th) {
    //         DB::rollback();
    //         return redirect()->route('roles.index')->with('error',$th->getMessage());
    //     }
    // }
}