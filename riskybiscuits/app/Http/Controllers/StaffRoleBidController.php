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
            $staffrolebids = StaffRoleBid::query()->where('user_id', auth()->user()->id)->paginate(10);
            $staffroles = StaffRoles::paginate(10);
            $users = User::query()->where('id', auth()->user()->id)->paginate(10);
            return view('staffrolebids.index', [
                'staffrolebids' => $staffrolebids,
                'staffroles' => $staffroles,
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

        return view('staffrolebids.add', ['permissions' => $permissions]);
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
            return redirect()->route('staffrolebids.index')->with('success','Roles created successfully.');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('staffrolebids.add')->with('error',$th->getMessage());
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::whereId($id)->with('permissions')->first();
        
        $permissions = Permission::all();

        return view('staffrolebids.edit', ['staffrolebids' => $staffrolebids, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            // Validate Request
            $request->validate([
                'status' => 'required',
            ]);
            
            $role = Role::whereId($id)->first();
            $staffrolebid = StaffRoleBid::whereId($request->id);
            $staffrolebid->status = $request->status;
            $staffrolebid->save();

            DB::commit();
            return redirect()->route('staffrolebids.index')->with('success','Staff Role Bids updated successfully.');
        
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('staffrolebids.index',['staffrolebid' => $staffrolebid])->with('error',$th->getMessage());
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