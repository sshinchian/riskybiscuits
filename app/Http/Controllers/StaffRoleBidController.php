<?php

namespace App\Http\Controllers;
use App\Models\StaffRoles;
use App\Models\StaffRoleBid;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StaffRoleBidController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:staffrolebid-list|staffrolebid-create|staffrolebid-edit|staffrolebid-delete', ['only' => ['index']]);
        $this->middleware('permission:staffrolebid-create', ['only' => ['create','store']]);
        $this->middleware('permission:staffrolebid-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:staffrolebid-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role_id == 3) {
            $staffrolebids = StaffRoleBid::paginate(10);
            $staffroles = StaffRoles::paginate(10);
            $users = User::paginate(10);
            return view('staffrolebids.index', [
                'staffrolebids' => $staffrolebids,
                'staffroles' => $staffroles,
                'users' => $users
            ]);
        } else if(auth()->user()->role_id == 4) {
            $staffrolebids = StaffRoleBid::where('user_id', auth()->user()->id)->paginate(10);
            $staffroles = StaffRoles::paginate(10);
            $users = User::query()->where('id', auth()->user()->id)->paginate(10);
            return view('staffrolebids.index', [
                'staffrolebids' => $staffrolebids,
                'staffroles' => $staffroles,
                'users' => $users
            ]);
        }
    }

    public function create()
    {
        $permissions = Permission::all();
        $staffroles = StaffRoles::query()
                            ->where('id', auth()->user()->staff_role_id)
                            ->whereNull('deleted_at')
                            ->paginate(10);
        $staffrolebids = StaffRoleBid::query()
                            ->where('user_id', auth()->user()->id)
                            ->whereNull('deleted_at')
                            ->paginate(10);

        return view('staffrolebids.create', [
            'staffroles' => $staffroles,
            'staffrolebids' => $staffrolebids, // Pass the $staffrolebids variable to the view
            'permissions' => $permissions,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $permissions = Permission::all();

    //     return view('staffrolebids.add', ['permissions' => $permissions]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $request->validate([
    //             'name' => 'required',
    //             'guard_name' => 'required'
    //         ]);
    
    //         Role::create($request->all());

    //         DB::commit();
    //         return redirect()->route('staffrolebids.index')->with('success','Roles created successfully.');
    //     } catch (\Throwable $th) {
    //         DB::rollback();
    //         return redirect()->route('staffrolebids.add')->with('error',$th->getMessage());
    //     }
        
    // }

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $role = Role::whereId($id)->with('permissions')->first();
        
    //     $permissions = Permission::all();

    //     return view('staffrolebids.edit', ['staffrolebids' => $staffrolebids, 'permissions' => $permissions]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffRoleBid $staffRoleBid)
    {


        // Validate Request
        $request->validate([
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            
            $staffRoleBid->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);

            if($request->status == 1){
                $user = User::whereId($request->user_id)->first();
                $user->update ([
                    'staff_role_id'=> $request->staff_role_id,    
                ]);
            }
            
            DB::commit();
            return redirect()->route('staffrolebid.index')->with('success','Staff Role Bids updated successfully.');
        
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('staffrolebid.index',['staffRoleBid' => $staffRoleBid])->with('error',$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
    
            StaffRoleBid::where(['id' => $id])->delete();
            
            DB::commit();
            return redirect()->route('staffrolebid.index')->with('success','Staff role bids deleted successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('staffrolebid.index')->with('error',$th->getMessage());
        }
    }


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