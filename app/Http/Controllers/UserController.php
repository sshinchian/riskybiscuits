<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkSlotBid;
use App\Models\StaffRoles;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store', 'updateStatus']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }


    public function index()
    {
        $users = User::all();
       /*  $users = User::with('roles', 'staffRole')->paginate(200); */
        return view('users.index', ['users' => $users]);
    }

   
    public function create()
    {
        $roles = Role::all();
       
        return view('users.add', ['roles' => $roles]);
    }


    public function store(Request $request)
    {
        // Validations
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|unique:users,email',
            'mobile_number' => 'required|numeric|digits:8',
            'role_id'       =>  'required|exists:roles,id',
            /* 'requested_workslots' => 'required', */
            'status'       =>  'required|numeric|in:0,1',
        ]);



        DB::beginTransaction();
        try {

            // Store Data
            $user = User::create([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'role_id'       => $request->role_id,
                //'staff_role_id' => $request->staff_role_id,
                //'requested_workslots' => $request->requested_workslots,
                'status'        => $request->status,
                'password' => Hash::make($request->password), // Set the password field
                
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            
            // Assign Role To User
            $user->assignRole($user->role_id);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('users.index')->with('success','User Created Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function updateStatus($user_id, $status)
    {
        // Validation
        $validate = Validator::make([
            'user_id'   => $user_id,
            'status'    => $status
        ], [
            'user_id'   =>  'required|exists:users,id',
            'status'    =>  'required|in:0,1',
        ]);

        // If Validations Fails
        if($validate->fails()){
            return redirect()->route('users.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            User::whereId($user_id)->update(['status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('users.index')->with('success','User Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(User $user)
    {
        $staffRoles = StaffRoles::all();
        $roles = Role::all();
        
        return view('users.edit')->with([
            'staffRoles'=> $staffRoles,
            'roles' => $roles,
            'user'  => $user
        ]);
    }


    public function update(Request $request, User $user)
    {
        // Validations
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|unique:users,email,'.$user->id.',id',
            'mobile_number' => 'required|numeric|digits:8',
            'role_id'       =>  'required|exists:roles,id',
            'staff_role_id' => 'required',
            /* 'requested_workslots' => 'required', */
            'status'       =>  'required|numeric|in:0,1',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $user_updated = User::whereId($user->id)->update([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'role_id'       => $request->role_id,
                'staff_role_id' => $request->staff_role_id,
                'requested_workslots' => $request->requested_workslots,
                'status'        => $request->status,
                'password' => Hash::make($request->password), // Update the password
                
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            
            // Assign Role To User
            $user->assignRole($user->role_id);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('users.index')->with('success','User Updated Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }


    public function delete(User $user)
    {
        DB::beginTransaction();
        try {
            //dd($user);
            // Delete User
            User::whereId($user->id)->delete();

            DB::commit();
            return redirect()->route('users.index')->with('success', 'User Deleted Successfully!.');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


    public function importUsers()
    {
        return view('users.import');
    }

    public function uploadUsers(Request $request)
    {
        Excel::import(new UsersImport, $request->file);
        
        return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function slots()
    {
        if(auth()->user()->role_id == 3){
            $users = User::query()->where('role_id',4)->get();
            $workslotbids = WorkSlotBid::all();
        } 
        return view('users.slots', ['users' => $users, 'workslotbids' => $workslotbids]);
    }
    
    public function updateslots(Request $request, User $user)
    {
        //Validation
        $current = WorkSlotBid::query()->where('user_id',$user->id)->where('status','>=','0')->count();
        $request->validate([
            'requested_workslots_' . $user->id => 'required|numeric|between:'. $current.',30',
        ]);


        DB::beginTransaction();
        try {
            $qty = 'requested_workslots_'.$user->id;
            // Store Data
            $user_updated = User::whereId($user->id)->update([
                'requested_workslots' => $request->$qty,
            ]);
            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('users.slots')->with('success','Requested Workslots Updated Successfully.');

        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

}
