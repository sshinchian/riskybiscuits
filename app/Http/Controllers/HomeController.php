<?php

namespace App\Http\Controllers;

use App\Models\StaffRoleBid;
use App\Models\WorkSlotBid;
use App\Models\WorkSlot;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


     public function index(Request $request)
     {

        $user = auth()->user();

        //Total number of workslot bids for the logged-in user
        $totalWorkSlotBids = $user->workSlotBid()->count();

        //Total number of approved workslot bids for the logged-in user
        $approvedWorkSlotBids = $user->workSlotBid()->where('status', 1)->count();

         $staffCount = User::where('role_id', 4)->count();
         $chefCount = User::where('staff_role_id', 2)->count();
         $waiterCount = User::where('staff_role_id', 3)->count();
         $cashierCount = User::where('staff_role_id', 1)->count();
     
         $pendingStaffRoleApprovalCount = StaffRoleBid::whereHas('user', function ($query) {$query->where('role_id', 4);
         })->where('status', 0)->count();

         $pendingWorkslotApprovalCount = WorkSlotBid::whereHas('user', function ($query) {$query->where('role_id', 4);
         })->where('status', 0)->count();

        //Retrieve the count of work slots that do not have a corresponding entry in the WorkSlotBid table
        $availableWorkslotsCount = WorkSlot::whereNotIn('id', WorkSlotBid::where('status', 1)
        ->pluck('work_slot_id'))
        ->count();

        //Calling function and passing in staff_role_id as the parameter
        $availableWorkslotsCountForChef = $this->getAvailableWorkslotsCount(2);
        $availableWorkslotsCountForWaiter = $this->getAvailableWorkslotsCount(3);
        $availableWorkslotsCountForCashier = $this->getAvailableWorkslotsCount(1);

        //Retrieve dynamic data for the pie chart
        $countData = [$chefCount, $cashierCount, $waiterCount];

        //Retrieve dynamic data for the bar chart - count of available workslots for each day of the week
        $dayOfWeekCounts = [];
        for ($day = 1; $day <= 7; $day++) {
            // Get the count of available workslots for the current day
            $count = WorkSlot::whereRaw('DAYOFWEEK(start_date) = ?', [$day])
                ->whereNotIn('id', WorkSlotBid::where('status', 1)->pluck('work_slot_id'))
                ->count();

            //Add the count to the data array
            $dayOfWeekCounts[] = $count;
        }
     
         return view('home', compact('staffCount', 'pendingStaffRoleApprovalCount',
         'pendingWorkslotApprovalCount', 'availableWorkslotsCount', 'countData',
         'availableWorkslotsCountForChef','availableWorkslotsCountForWaiter',
         'availableWorkslotsCountForCashier','totalWorkSlotBids','approvedWorkSlotBids','dayOfWeekCounts'));
     }


     //For staff dashboard - get data based on staff_role_id
     public function getAvailableWorkslotsCount($staffRoleId)
    {
        return WorkSlot::whereNotIn('id', WorkSlotBid::where('status', 1)->pluck('work_slot_id'))
            ->where('staff_role_id', $staffRoleId)
            ->count();
    }


    public function getProfile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        #Validations
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'mobile_number' => 'required|numeric|digits:8',
        ]);

        try {
            DB::beginTransaction();
            
            #Update Profile Data
            User::whereId(auth()->user()->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile_number' => $request->mobile_number,
            ]);

            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'Profile Updated Successfully.');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }

   
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        try {
            DB::beginTransaction();

            #Update Password
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            
            #Commit Transaction
            DB::commit();

            #Return To Profile page with success
            return back()->with('success', 'Password Changed Successfully.');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', $th->getMessage());
        }
    }
}

