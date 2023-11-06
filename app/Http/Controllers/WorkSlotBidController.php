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
            $workslotbids = WorkSlotBid::query()
                            ->where('user_id', auth()->user()->id)
                            ->whereNull('deleted_at')
                            ->paginate(10);

            $workslots = WorkSlot::paginate(10);
            $users = User::query()->where('id', auth()->user()->id)->paginate(10);
            return view('workslotbids.index', [
                'workslotbids' => $workslotbids,
                'workslots' => $workslots,
                'users' => $users
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $workslots = WorkSlot::paginate(10);

        return view('workslotbids.create',['workslots' => $workslots], ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     /*
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                //'name' => 'required',
                //'guard_name' => 'required'
            ]);
    
            Role::create($request->all());

            DB::commit();
            return redirect()->route('workslotbids.create')->with('success','Work slot bid created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('workslotbids.create')->with('error',$th->getMessage());
        }
        
    }
    */

    public function store(Request $request)
    {
        $request->validate([
        'work_slot_id' => 'required',
        'user_id' => 'required'
        ]);

        DB::beginTransaction();
        try {
            // Store Data
            $bid = WorkSlotBid::create([
                'work_slot_id' => $request->work_slot_id,
                'user_id' => $request->user_id,
                'status' => '0',
                'created_at' => now()
            ]);

            // Commit And Redirected To Listing
            DB::commit();

                
            //dd($request);
            return redirect()->route('workslotbids.create')->with('success','Bid Created Successfully.');


        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->route('workslotbids.create')->with('error',$th->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $workslotbid = WorkSlotBid::withTrashed()->find($id);

        if ($workslotbid) {
            // Soft delete by updating the deleted_at timestamp
            $workslotbid->delete();

            return redirect()->route('workslotbids.index')->with('success', 'Bid Deleted Successfully.');
        } else {
            return redirect()->route('workslotbids.index')->with('error', 'Work slot bid not found.');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//     public function show($id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function edit($id)
//     {
//         $role = Role::whereId($id)->with('permissions')->first();
        
//         $permissions = Permission::all();

//         return view('workslotbids.edit', ['workslotbids' => $workslotbids, 'permissions' => $permissions]);
//     }

//     /**
//      * Update the specified resource in storage.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function update(Request $request, $id)
//     {
//         DB::beginTransaction();
//         try {

//             // Validate Request
//             $request->validate([
//                 'name' => 'required',
//                 'guard_name' => 'required'
//             ]);
            
//             $role = Role::whereId($id)->first();

//             $role->name = $request->name;
//             $role->guard_name = $request->guard_name;
//             $role->save();

//             // Sync Permissions
//             $permissions = $request->permissions;
//             $role->syncPermissions($permissions);
            
//             DB::commit();
//             return redirect()->route('roles.index')->with('success','Roles updated successfully.');
//         } catch (\Throwable $th) {
//             DB::rollback();
//             return redirect()->route('roles.edit',['role' => $role])->with('error',$th->getMessage());
//         }
//     }

//     /**
//      * Remove the specified resource from storage.
//      *
//      * @param  int  $id
//      * @return \Illuminate\Http\Response
//      */
//     public function destroy($id)
//     {
//         DB::beginTransaction();
//         try {
    
//             Role::whereId($id)->delete();
            
//             DB::commit();
//             return redirect()->route('roles.index')->with('success','Roles deleted successfully.');
//         } catch (\Throwable $th) {
//             DB::rollback();
//             return redirect()->route('roles.index')->with('error',$th->getMessage());
//         }
//     }
}